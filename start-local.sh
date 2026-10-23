#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")" && pwd)"
MYSQL_BIN="${MYSQL_BIN:-mysql}"
PHP_BIN="${PHP_BIN:-/opt/homebrew/opt/php@8.5/bin/php}"
# Hide deprecations noise on legacy WP 5.0; fatals/warnings still visible in debug.log
PHP_FLAGS="-d error_reporting=22519 -d display_errors=0 -d zend.exception_ignore_args=1"
PORT="${PORT:-8888}"

if ! "$MYSQL_BIN" -u root -e "USE vipclinik_s" 2>/dev/null; then
  echo "Database vipclinik_s not found. Import vipclinik_s.sql.gz first:"
  echo "  gunzip -c vipclinik_s.sql.gz | $MYSQL_BIN -u root vipclinik_s"
  exit 1
fi

echo "Starting vipclinik at http://localhost:${PORT} (PHP: $("$PHP_BIN" -v | head -1))"
cd "$ROOT"
"$PHP_BIN" $PHP_FLAGS -S "localhost:${PORT}" -t vipclinik.com router.php
