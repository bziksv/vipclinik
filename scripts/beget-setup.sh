#!/usr/bin/env bash
# Копирует из git-репозитория на live public_html (только то, что в git).
#
#   cd ~/vipclinik
#   ./scripts/beget-setup.sh
#
set -euo pipefail

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
# shellcheck source=beget-lib.sh
source "$REPO_ROOT/scripts/beget-lib.sh"

beget_require_web

SRC="$REPO_ROOT/vipclinik.com"

if [ ! -d "$SRC/wp-content/themes/clinic" ]; then
  echo "Не найдена тема: $SRC/wp-content/themes/clinic"
  exit 1
fi

sync_dir() {
  local rel="$1"
  echo "→ $rel"
  mkdir -p "$BEGET_WEB/$rel"
  if command -v rsync >/dev/null 2>&1; then
    rsync -a --delete "$SRC/$rel/" "$BEGET_WEB/$rel/"
  else
    rm -rf "$BEGET_WEB/$rel"
    mkdir -p "$BEGET_WEB/$rel"
    cp -a "$SRC/$rel/." "$BEGET_WEB/$rel/"
  fi
}

echo "Deploy: $SRC → $BEGET_WEB"
echo ""

sync_dir "wp-content/themes/clinic"
sync_dir "wp-content/documents"

PATCH="wp-content/plugins/types/embedded/common/toolset-forms/lib/adodb-time.inc.php"
if [ -f "$SRC/$PATCH" ]; then
  echo "→ $PATCH"
  mkdir -p "$BEGET_WEB/$(dirname "$PATCH")"
  cp "$SRC/$PATCH" "$BEGET_WEB/$PATCH"
fi

if [ -f "$SRC/.htaccess" ]; then
  echo "→ .htaccess"
  cp "$SRC/.htaccess" "$BEGET_WEB/.htaccess"
fi

echo ""
echo "✓ Готово: https://vipclinik.com"
echo "  PDF: https://vipclinik.com/wp-content/documents/consent.pdf"
