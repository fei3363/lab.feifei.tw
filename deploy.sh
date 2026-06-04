#!/bin/bash
# Deploy script for lab.feifei.tw
# Restore www/.git from backup before starting services

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"

# Restore www/.git if backup exists and .git doesn't
if [ -f "$SCRIPT_DIR/www/git_backup.tar.gz" ] && [ ! -d "$SCRIPT_DIR/www/.git" ]; then
    echo "[deploy] Restoring www/.git from git_backup.tar.gz ..."
    mkdir -p "$SCRIPT_DIR/www/.git"
    tar xzf "$SCRIPT_DIR/www/git_backup.tar.gz" -C "$SCRIPT_DIR/www/.git"
    echo "[deploy] www/.git restored."
else
    echo "[deploy] www/.git already exists or backup not found, skipping restore."
fi

# Start services
echo "[deploy] Starting docker-compose ..."
cd "$SCRIPT_DIR"
docker-compose up -d
