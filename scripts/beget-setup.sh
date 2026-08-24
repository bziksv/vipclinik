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

# Старые PDF в uploads — удалить, иначе nginx отдаёт файл (200) вместо 301 из .htaccess
OLD_PDFS=(
  "wp-content/uploads/2026/02/cookies-vipclinic.pdf"
  "wp-content/uploads/2026/03/consent-personal-data-vipclinic.pdf"
  "wp-content/uploads/2026/03/personal-data-vipclinic.pdf"
  "wp-content/uploads/2026/03/rules-recommendation-vipclinic.pdf"
)
for rel in "${OLD_PDFS[@]}"; do
  if [ -f "$BEGET_WEB/$rel" ]; then
    echo "→ удалён старый $rel (редирект на documents/)"
    rm -f "$BEGET_WEB/$rel"
  fi
done

if [ -f "$REPO_ROOT/scripts/db-sync.php" ] && [ -f "$BEGET_WEB/wp-load.php" ]; then
  echo "→ database sync"
  PHP_BIN="${PHP_BIN:-php}"
  BEGET_WEB="$BEGET_WEB" "$PHP_BIN" "$REPO_ROOT/scripts/db-sync.php"
fi

echo ""
echo "✓ Готово: https://vipclinik.com"
echo "  PDF: https://vipclinik.com/wp-content/documents/consent.pdf"
