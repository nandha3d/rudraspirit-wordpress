# WordPress CI/CD Architecture & Guide (`rudraspirit.com`)

This repository includes industry-standard Continuous Integration (CI) and Continuous Deployment (CD) pipelines configured for both **GitHub Actions** (`.github/workflows/`) and **GitLab CI** (`.gitlab-ci.yml`).

---

## 🏗️ Pipeline Overview

### 1. Continuous Integration (`ci.yml`)
Runs automatically on every **Pull Request** and **Push** to main branches (`main`, `develop`, `staging`).
- **PHP Syntax Linter (`php -l`)**: Scans `wp-content/themes/vemus-child/` and `wp-content/plugins/vemus-addon/` to catch syntax errors or fatal bugs before code reaches production.
- **Security & Artifact Scan**: Checks that sensitive files (`wp-config.php`, `.env`, backup `.sql` files, or large `.tar.gz` dumps) are not committed into Git.
- **Theme Structure Validation**: Verifies that `style.css` contains valid headers (`Theme Name: ...`).

### 2. Continuous Deployment (`deploy.yml`)
Runs automatically when code is pushed/merged to `main`, or can be triggered manually via **GitHub Actions -> Run Workflow (`workflow_dispatch`)**.

| Deployment Mode | Trigger | Scope | Description |
| :--- | :--- | :--- | :--- |
| **`code_only`** | Automatic on `push` to `main`, or manual | `vemus-child/` & `vemus-addon/` | Fast, zero-downtime deployment of theme and custom plugin code via SSH/rsync. Flushes object cache after deploy. |
| **`full_sync_including_uploads`** | Manual via `workflow_dispatch` | Entire `wp-content/` folder | Pushes all code, third-party plugins, and `/uploads/` images. Skips local cache folders (`/cache`, `*.log`). |
| **`database_and_code`** | Manual (Local CLI / script) | Database + Files | Uses `./deploy.sh db` or custom SSH scripts for database replacement. |

---

## 🔑 Required Secrets Configuration

To enable remote deployments to Hostinger, add the following **Repository Secrets** in your Git hosting platform:

### For GitHub Actions:
Go to **Settings** -> **Secrets and variables** -> **Actions** -> **New repository secret**:
1. `SSH_PRIVATE_KEY`: Your private SSH key (from `~/.ssh/hostinger_rudraspirit` or generated via `./deploy.sh setup`).
2. `SSH_HOST`: `217.21.74.44` (Hostinger server IP).
3. `SSH_PORT`: `65002` (Hostinger SSH port).
4. `SSH_USER`: `u362580417` (Hostinger SSH user).

### For GitLab CI:
Go to **Settings** -> **CI/CD** -> **Variables** -> **Add variable**:
- `SSH_PRIVATE_KEY` (Masked & Protected)
- `SSH_HOST`, `SSH_PORT`, `SSH_USER`

---

## 🛠️ Local Deploy Scripts vs. CI/CD Pipeline

| Feature | Local CLI (`./deploy.sh`) | Automated CI/CD (GitHub / GitLab) |
| :--- | :--- | :--- |
| **Primary Use Case** | Rapid development, DB push (`./deploy.sh db`), backup snapshots (`./deploy.sh backup`) | Multi-developer collaboration, automated staging/prod releases, strict code checks |
| **Incremental Files** | Yes (`--listed-incremental` tar snapshots in `.deploy/`) | Yes (`rsync -avz` differential sync over SSH) |
| **Database Sync** | Built-in (`./deploy.sh db` with live auto-backup) | Deliberately isolated (DB sync is triggered manually via Local CLI to prevent accidental production overwrites) |
| **Post-Deploy Verification** | Manual or `deploy.sh check` | Automated HTTP 200 health check after every deploy |
