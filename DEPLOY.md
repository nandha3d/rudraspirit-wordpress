# Deploy: LocalWP → Hostinger (rudraspirit.com)

One command pushes this local site (code + uploads + database) to the live
Hostinger server over SSH.

## Server
- SSH: `u362580417@217.21.74.44:65002`
- Live: https://rudraspirit.com
- Local URL in DB: `http://test.local` (rewritten to live on deploy)

## First-time setup (once)

```bash
cd /d/PROJECTS/WEBSITES/rudraspirit02
./deploy.sh setup     # generates ~/.ssh/hostinger_rudraspirit, prints public key
```

Install the printed key on the server (enter the SSH password once):

```bash
ssh-copy-id -i ~/.ssh/hostinger_rudraspirit.pub -p 65002 u362580417@217.21.74.44
```
…or paste the public key into hPanel → Advanced → SSH Access → Manage SSH Keys.

Verify:
```bash
./deploy.sh check     # read-only: tests SSH, finds live WP path, checks wp-cli
```

## Deploy

```bash
./deploy.sh deploy    # push CHANGED wp-content files only (incremental). No DB.
./deploy.sh full      # force a full file resync (resets incremental state)
./deploy.sh db        # push the database (FULL, overwrites live DB) - asks to confirm
./deploy.sh backup    # snapshot live DB + wp-content on the server
```

### Files = incremental (rsync-like, via GNU tar)
- First `deploy` sends all of wp-content and saves a snapshot in `.deploy/`.
- Every later `deploy` sends **only changed/new files**, and deletes on live
  what you deleted locally. Fast.
- Run `./deploy.sh full` if you ever want to force a clean full re-push.

### Database = separate, on purpose
- `deploy` NEVER touches the live DB. Routine code pushes are safe.
- Run `./deploy.sh db` only when you intend to overwrite live data.

## ⚠️ What `db` does
- **Overwrites the live database.** Live admin login becomes your *local*
  username/password. Anything created only on live (orders, comments, new
  posts) is destroyed. Live DB is backed up first to `~/deploy-backups/`.

## What deploy never touches
- live `wp-config.php`, WordPress core, the real `hostinger-*` plugins
  (your local copies are disabled), and cache/log files.

## Rollback
Each deploy backs up live first to `~/deploy-backups/<timestamp>/` on the server:
```bash
ssh -p 65002 u362580417@217.21.74.44
cd ~/domains/rudraspirit.com/public_html
wp db import ~/deploy-backups/<timestamp>/db.sql
tar xzf ~/deploy-backups/<timestamp>/wp-content.tar.gz -C .
```

## Notes
- Config (paths, ports, URLs) lives in `deploy.config.sh`.
- Hostinger plugins are disabled locally (renamed `*.disabled`) because they
  crash off Hostinger infra. They stay active on live and are excluded from the
  push.
