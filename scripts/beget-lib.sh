#!/usr/bin/env bash
# Общие пути Beget для vipclinik.com
# Переопределить: export BEGET_WEB=/path/to/public_html

: "${HOME:?HOME is not set}"

BEGET_WEB="${BEGET_WEB:-$HOME/vipclinik.com/public_html}"

beget_require_web() {
  if [ ! -d "$BEGET_WEB" ]; then
    echo "Нет каталога сайта: $BEGET_WEB"
    echo "Укажите путь: export BEGET_WEB=/home/USER/vipclinik.com/public_html"
    exit 1
  fi
}
