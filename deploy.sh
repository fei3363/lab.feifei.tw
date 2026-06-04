#!/bin/bash
# Deploy script for lab.feifei.tw

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$SCRIPT_DIR"

echo "[deploy] Building and starting services ..."
docker-compose up -d --build
echo "[deploy] Done."
