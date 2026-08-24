#!/usr/bin/env bash
# Обновление prod: git pull + выкладка файлов на public_html.
#
#   cd ~/vipclinik
#   ./scripts/beget-deploy.sh
#
set -euo pipefail

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"

if command -v git >/dev/null && git -C "$REPO_ROOT" rev-parse --is-inside-work-tree >/dev/null 2>&1; then
  echo "→ git pull origin main"
  git -C "$REPO_ROOT" pull --ff-only origin main
fi

exec "$REPO_ROOT/scripts/beget-setup.sh"
