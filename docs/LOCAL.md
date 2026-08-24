# Локальная разработка

## Требования

- macOS / Linux
- MySQL (Homebrew: `brew install mysql`)
- PHP **7.4** — `brew install php@7.4`  
  WordPress 5.0 несовместим с PHP 8.x

## Быстрый старт

```bash
# 1. Импорт базы (один раз)
mysql -u root -e "CREATE DATABASE IF NOT EXISTS vipclinik_s CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
gunzip -c vipclinik_s.sql.gz | mysql -u root vipclinik_s

# 2. Запуск
./start-local.sh
```

Сайт: **http://localhost:8888**

> Используйте именно `http://`, не `https://`.  
> Порт 8080 может быть занят — по умолчанию используется 8888.  
> Другой порт: `PORT=9000 ./start-local.sh`

## Конфигурация

| Файл | Назначение |
|------|------------|
| `vipclinik.com/wp-config.php` | прод-конфиг (на сервере) |
| `vipclinik.com/wp-config-local.php` | локальные переопределения (создан, в git не попадает) |
| `router.php` | роутер для встроенного PHP-сервера |
| `start-local.sh` | скрипт запуска |

`wp-config-local.php` автоматически подключается, если файл существует. На проде его нет — работает обычный `wp-config.php`.

## Админка

- URL: http://localhost:8888/wp-admin/
- Пользователи из дампа: `admin`, `primeseo`, `primedev`

## Известные ограничения локально

- Картинки в контенте могут ссылаться на `https://vipclinik.com` — медиа лежат в `uploads/`, в git не включены
- SSL-редирект отключён через `mu-plugins/local-dev.php`
- WP-Cron отключён (`DISABLE_WP_CRON`)

## Переимпорт базы

```bash
mysql -u root -e "DROP DATABASE vipclinik_s; CREATE DATABASE vipclinik_s CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
gunzip -c vipclinik_s.sql.gz | mysql -u root vipclinik_s
```
