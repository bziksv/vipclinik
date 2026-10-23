# Локальная разработка

## Требования

- macOS / Linux
- MySQL (Homebrew: `brew install mysql`)
- PHP **8.5** — `brew install php@8.5` (по умолчанию в `start-local.sh`)  
  Откат: `PHP_BIN=/opt/homebrew/opt/php@7.4/bin/php ./start-local.sh`  
  Локально: WordPress **7.1.3** (апгрейд с 5.0.27). Бэкап БД до апгрейда: `.local-backup/`

## Быстрый старт

```bash
# 1. Импорт базы (один раз)
mysql -u root -e "CREATE DATABASE IF NOT EXISTS vipclinik_s CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
gunzip -c vipclinik_s.sql.gz | mysql -u root vipclinik_s

# 2. Запуск
cd /Users/stanislav/Documents/projects/vipclinik
./start-local.sh
```

Сайт: **http://localhost:8888**

> Используйте `http://`, не `https://`.  
> Порт по умолчанию: **8888**. Другой: `PORT=9000 ./start-local.sh`

Порт занят:

```bash
kill $(lsof -t -i:8888) && ./start-local.sh
```

## Конфигурация

| Файл | Назначение |
|------|------------|
| `vipclinik.com/wp-config.php` | прод-конфиг (на сервере) |
| `vipclinik.com/wp-config-local.php` | локальные переопределения (в git не попадает) |
| `router.php` | роутер PHP-сервера (PDF, редиректы, WordPress) |
| `start-local.sh` | скрипт запуска |

## Админка

- URL: http://localhost:8888/wp-admin/
- Пользователи из дампа: `admin`, `primeseo`, `primedev`

## PDF и политики локально

Документы: `vipclinik.com/wp-content/documents/`

- http://localhost:8888/wp-content/documents/consent.pdf
- http://localhost:8888/wp-content/documents/personal-data.pdf
- http://localhost:8888/wp-content/documents/cookies.pdf
- http://localhost:8888/wp-content/documents/rules-recommendation.pdf

## Синхронизация БД локально

Проверить cookie-баннер и URL в базе до деплоя:

```bash
cd /Users/stanislav/Documents/projects/vipclinik
BEGET_WEB="$(pwd)/vipclinik.com" php scripts/db-sync.php
```

## Известные ограничения локально

- Медиа в `uploads/` не в git — часть картинок грузится с прода
- SSL-редирект отключён через `mu-plugins/local-dev.php`
- WP-Cron отключён (`DISABLE_WP_CRON`)

## Переимпорт базы

```bash
mysql -u root -e "DROP DATABASE vipclinik_s; CREATE DATABASE vipclinik_s CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
gunzip -c vipclinik_s.sql.gz | mysql -u root vipclinik_s
```

## Деплой на прод

После правок: [DEPLOY.md](DEPLOY.md)
