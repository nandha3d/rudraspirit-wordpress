#!/usr/bin/env bash
#
# deploy.sh - LocalWP -> Hostinger (rudraspirit.com)
#
#   ./deploy.sh setup     One-time: generate SSH key + show install line.
#   ./deploy.sh check     Test SSH, live WP path, wp-cli, local DB. Read-only.
#   ./deploy.sh deploy    Push CHANGED wp-content files (incremental). No DB.
#   ./deploy.sh full      Force a FULL file resync (resets incremental state).
#   ./deploy.sh db        Push the database (FULL, overwrites live DB). Backs up first.
#   ./deploy.sh backup    Snapshot live DB + wp-content on the server only.
#
# Files use GNU tar incremental: first run sends everything, later runs send
# only what changed (and delete on live what you deleted locally).
# The DB is ALWAYS full and is its own command so routine code pushes never
# touch live data.
#
set -euo pipefail
cd "$(dirname "${BASH_SOURCE[0]}")"
source ./deploy.config.sh

STATE_DIR="./.deploy"
SNAR="$STATE_DIR/wp-content.snar"     # incremental snapshot (local, gitignored)
mkdir -p "$STATE_DIR"

STAMP="$(date +%Y%m%d-%H%M%S)"
TMP="$(mktemp -d)"
trap 'rm -rf "$TMP"' EXIT

c_red=$'\e[31m'; c_grn=$'\e[32m'; c_ylw=$'\e[33m'; c_rst=$'\e[0m'
say()  { echo "${c_grn}==>${c_rst} $*"; }
warn() { echo "${c_ylw}!! ${c_rst} $*"; }
die()  { echo "${c_red}xx ${c_rst} $*" >&2; exit 1; }

SSH_OPTS=(-p "$SSH_PORT" -i "$SSH_KEY" -o StrictHostKeyChecking=accept-new)
remote() { ssh "${SSH_OPTS[@]}" "${SSH_USER}@${SSH_HOST}" "export PATH=/opt/alt/php83/usr/bin:\$PATH; $*"; }

resolve_remote_wp() {
  if [ "$REMOTE_WP" != "AUTO" ]; then echo "$REMOTE_WP"; return; fi
  remote 'for d in "$HOME/domains/'"$LIVE_HOST"'/public_html" "$HOME/public_html" $HOME/domains/*/public_html; do
            [ -f "$d/wp-load.php" ] && { echo "$d"; exit 0; }
          done; exit 1'
}

# ---------------------------------------------------------------- setup
cmd_setup() {
  if [ -f "$SSH_KEY" ]; then say "Key exists: $SSH_KEY"
  else say "Generating SSH key: $SSH_KEY"; ssh-keygen -t ed25519 -N "" -f "$SSH_KEY" -C "deploy-rudraspirit"; fi
  echo; say "Public key:"; cat "${SSH_KEY}.pub"; echo
  warn "Install once (enter SSH password):"
  echo "    ssh-copy-id -i \"${SSH_KEY}.pub\" -p ${SSH_PORT} ${SSH_USER}@${SSH_HOST}"
  echo "  or hPanel -> Advanced -> SSH Access -> Manage SSH Keys."
  echo; echo "Verify:  ./deploy.sh check"
}

# ---------------------------------------------------------------- check
cmd_check() {
  [ -f "$SSH_KEY" ] || die "No SSH key. Run: ./deploy.sh setup"
  say "Testing SSH ..."; remote 'echo "  ok: $(whoami)@$(hostname)"'
  local wp; wp="$(resolve_remote_wp)" || die "Live WordPress not found. Set REMOTE_WP in deploy.config.sh"
  say "Live WP: $wp"
  remote "cd '$wp' && (wp --version 2>/dev/null || echo '  wp-cli NOT found')"
  say "Local mysqldump: $([ -x "$MYSQLDUMP" ] && echo OK || echo MISSING)"
  say "Local DB: $("$MYSQLDUMP" -h"$LOCAL_DB_HOST" -P"$LOCAL_DB_PORT" -u"$LOCAL_DB_USER" -p"$LOCAL_DB_PASS" --no-data "$LOCAL_DB_NAME" >/dev/null 2>&1 && echo OK || echo 'FAIL - is the site running in LocalWP?')"
  say "Incremental state: $([ -f "$SNAR" ] && echo 'exists (next deploy = changed files only)' || echo 'none (next deploy = full)')"
}

# ---------------------------------------------------------------- files (incremental)
push_files() {
  local wp="$1"
  local first="no"; [ -f "$SNAR" ] || first="yes"
  if [ "$first" = yes ]; then say "First sync: sending ALL wp-content (builds incremental state)."
  else say "Incremental: sending only changed files since last deploy."; fi
  # GNU tar incremental: snapshot tracks state; extract with --incremental applies deletions.
  tar --listed-incremental="$SNAR" "${TAR_EXCLUDES[@]}" -czf "$TMP/delta.tgz" -C "$LOCAL_PUBLIC" wp-content
  local sz; sz="$(du -h "$TMP/delta.tgz" | cut -f1)"
  say "Delta size: $sz  -> uploading ..."
  cat "$TMP/delta.tgz" | remote "cat > ~/deploy-delta-$STAMP.tgz && cd '$wp' && tar --listed-incremental=/dev/null -xzf ~/deploy-delta-$STAMP.tgz && rm -f ~/deploy-delta-$STAMP.tgz"
  say "Files synced ($sz transferred)."
}

# ---------------------------------------------------------------- db (full)
push_db() {
  local wp="$1"
  say "Dumping local DB ..."
  "$MYSQLDUMP" -h"$LOCAL_DB_HOST" -P"$LOCAL_DB_PORT" -u"$LOCAL_DB_USER" -p"$LOCAL_DB_PASS" \
    --single-transaction --quick --no-tablespaces --default-character-set=utf8mb4 \
    --add-drop-table "$LOCAL_DB_NAME" > "$TMP/db.sql"
  say "Dump $(du -h "$TMP/db.sql" | cut -f1). Backing up live DB ..."
  remote "set -e; mkdir -p ~/deploy-backups/$STAMP; cd '$wp'; wp db export ~/deploy-backups/$STAMP/db.sql --default-character-set=utf8mb4 >/dev/null 2>&1 || true"
  say "Uploading + importing + fixing URLs ..."
  cat "$TMP/db.sql" | remote "cat > ~/deploy-db-$STAMP.sql && cd '$wp' \
    && wp db import ~/deploy-db-$STAMP.sql \
    && wp search-replace '$LOCAL_URL' '$LIVE_URL' --all-tables --skip-columns=guid --report-changed-only \
    && wp search-replace '$LOCAL_HOST' '$LIVE_HOST' --all-tables --skip-columns=guid --report-changed-only \
    && wp cache flush || true; wp rewrite flush || true; rm -f ~/deploy-db-$STAMP.sql"
  say "DB live. Rollback: ~/deploy-backups/$STAMP/db.sql"
}

# ---------------------------------------------------------------- pull (from live)
pull_files() {
  local wp="$1"
  say "Pulling live uploads, theme, and custom addon to local via rsync ..."
  rsync -avz -e "ssh -p $SSH_PORT -i $SSH_KEY -o StrictHostKeyChecking=accept-new" \
    --exclude='cache/' --exclude='*.log' --exclude='*.disabled' \
    "$SSH_USER@$SSH_HOST:$wp/wp-content/uploads/" "$LOCAL_PUBLIC/wp-content/uploads/"
  rsync -avz -e "ssh -p $SSH_PORT -i $SSH_KEY -o StrictHostKeyChecking=accept-new" \
    "$SSH_USER@$SSH_HOST:$wp/wp-content/themes/vemus-child/" "$LOCAL_PUBLIC/wp-content/themes/vemus-child/"
  rsync -avz -e "ssh -p $SSH_PORT -i $SSH_KEY -o StrictHostKeyChecking=accept-new" \
    "$SSH_USER@$SSH_HOST:$wp/wp-content/plugins/vemus-addon/" "$LOCAL_PUBLIC/wp-content/plugins/vemus-addon/"
  say "Files pulled successfully!"
}

pull_db() {
  local wp="$1"
  local LOCAL_MYSQL="$(echo "$MYSQLDUMP" | sed 's/mysqldump\.exe$/mysql.exe/')"
  say "Exporting live database from $LIVE_URL ..."
  remote "cd '$wp' && wp db export /tmp/deploy-pull-$STAMP.sql --default-character-set=utf8mb4 >/dev/null 2>&1 || true"
  say "Downloading live SQL dump ..."
  remote "cat /tmp/deploy-pull-$STAMP.sql && rm -f /tmp/deploy-pull-$STAMP.sql" > "$TMP/db-live.sql"
  say "Backing up local database to $STATE_DIR/local-prepull-$STAMP.sql ..."
  "$MYSQLDUMP" -h"$LOCAL_DB_HOST" -P"$LOCAL_DB_PORT" -u"$LOCAL_DB_USER" -p"$LOCAL_DB_PASS" \
    --single-transaction --quick --add-drop-table "$LOCAL_DB_NAME" > "$STATE_DIR/local-prepull-$STAMP.sql" || true
  say "Performing URL replacement ($LIVE_URL -> $LOCAL_URL) on downloaded SQL file ..."
  sed -i "s|${LIVE_URL}|${LOCAL_URL}|g; s|http://${LIVE_HOST}|${LOCAL_URL}|g; s|${LIVE_HOST}|${LOCAL_HOST}|g" "$TMP/db-live.sql"
  say "Importing live database into local LocalWP ($LOCAL_DB_NAME) ..."
  "$LOCAL_MYSQL" -h"$LOCAL_DB_HOST" -P"$LOCAL_DB_PORT" -u"$LOCAL_DB_USER" -p"$LOCAL_DB_PASS" "$LOCAL_DB_NAME" < "$TMP/db-live.sql"
  say "Pull DB complete! Local backup saved: $STATE_DIR/local-prepull-$STAMP.sql"
}

# ---------------------------------------------------------------- commands
cmd_deploy() {
  local wp; wp="$(resolve_remote_wp)" || die "Live WP not found"
  say "Deploying files to $LIVE_URL ($wp)"
  push_files "$wp"
  remote "cd '$wp' && wp cache flush >/dev/null 2>&1 || true"
  say "DONE (files only). DB unchanged. To push DB: ./deploy.sh db"
}

cmd_full() {
  warn "Resetting incremental state -> next push sends ALL files."
  rm -f "$SNAR"
  cmd_deploy
}

cmd_db() {
  local wp; wp="$(resolve_remote_wp)" || die "Live WP not found"
  warn "FULL DB push to $LIVE_URL. Overwrites live DB (users, orders, comments -> your local copy)."
  if [ "${FORCE_DB:-}" != "1" ]; then
    read -r -p "Type 'db' to continue: " a; [ "$a" = db ] || die "Aborted."
  fi
  push_db "$wp"
}

cmd_backup() {
  local wp; wp="$(resolve_remote_wp)" || die "Live WP not found"
  say "Snapshotting live -> ~/deploy-backups/$STAMP"
  remote "set -e; mkdir -p ~/deploy-backups/$STAMP; cd '$wp'
          wp db export ~/deploy-backups/$STAMP/db.sql --default-character-set=utf8mb4 >/dev/null 2>&1 || true
          tar czf ~/deploy-backups/$STAMP/wp-content.tar.gz -C '$wp' wp-content
          echo '  backup done: ~/deploy-backups/$STAMP'"
}

cmd_pull() {
  local wp; wp="$(resolve_remote_wp)" || die "Live WP not found"
  say "Pulling files (uploads, child theme, custom addon) from $LIVE_URL ($wp)"
  pull_files "$wp"
  say "DONE pulling files. DB unchanged. To pull DB: ./deploy.sh pull-db"
}

cmd_pull_db() {
  local wp; wp="$(resolve_remote_wp)" || die "Live WP not found"
  warn "FULL DB PULL from $LIVE_URL -> LocalWP ($LOCAL_DB_NAME). Overwrites your local DB."
  if [ "${FORCE_DB:-}" != "1" ]; then
    read -r -p "Type 'pull' to continue: " a; [ "$a" = pull ] || die "Aborted."
  fi
  pull_db "$wp"
}

case "${1:-}" in
  setup)    cmd_setup ;;
  check)    cmd_check ;;
  deploy)   cmd_deploy ;;
  full)     cmd_full ;;
  db)       cmd_db ;;
  backup)   cmd_backup ;;
  pull)     cmd_pull ;;
  pull-db)  cmd_pull_db ;;
  *) echo "Usage: ./deploy.sh {setup|check|deploy|full|db|backup|pull|pull-db}"; exit 1 ;;
esac
