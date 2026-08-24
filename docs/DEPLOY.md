# Деплой vipclinik.com на Beget

Репозиторий: [github.com/bziksv/vipclinik](https://github.com/bziksv/vipclinik)

## Обычная схема (как billiard.guru)

**Локально:**
```bash
cd /Users/stanislav/Documents/projects/vipclinik
git add ...
git commit -m "описание"
git push origin main
```

**На Beget по SSH:**
```bash
cd ~/vipclinik
git pull origin main
./scripts/beget-deploy.sh
```

Или одной командой (pull уже внутри):
```bash
cd ~/vipclinik && ./scripts/beget-deploy.sh
```

Проверка: https://vipclinik.com/wp-content/documents/consent.pdf

---

## Одноразовая настройка на Beget

### 1. SSH

Панель Beget → **SSH** → включить.

### 2. Клон репозитория

```bash
ssh USER@vipclinik.beget.tech

cd ~
git clone git@github.com:bziksv/vipclinik.git vipclinik
cd vipclinik
chmod +x scripts/*.sh
```

Если `git clone` по SSH не работает — добавь SSH-ключ Beget в GitHub (Settings → SSH keys) или клонируй по HTTPS.

### 3. Путь к сайту

По умолчанию скрипт кладёт файлы в `~/vipclinik.com/public_html`.

Если у тебя другой путь:
```bash
export BEGET_WEB=/home/USER/vipclinik.com/public_html
./scripts/beget-setup.sh
```

### 4. Первый деплой

```bash
cd ~/vipclinik
./scripts/beget-deploy.sh
```

---

## Что выкладывается

| Из git | → на сервер |
|--------|-------------|
| `wp-content/themes/clinic/` | тема |
| `wp-content/documents/` | PDF политики |
| `wp-content/plugins/types/.../adodb-time.inc.php` | патч PHP 7.4 |
| `.htaccess` | редиректы PDF |
| `scripts/db/gdpr-infobar.html` + `scripts/db-sync.php` | cookie-баннер и URL в БД |

**Не трогаем:** uploads, wp-config.php, ядро WP, плагины (кроме патча).

При деплое **`db-sync.php`** автоматически:
- обновляет текст cookie-баннера (Moove GDPR);
- меняет старые ссылки на PDF в `wp_options`, формах CF7 и страницах.
- текст чекбоксов форм на сайте задаёт тема (`main.js`) — тоже через git.

---

## Локальная разработка

```bash
cd /Users/stanislav/Documents/projects/vipclinik
./start-local.sh
```

→ http://localhost:8888

---

## Альтернатива: GitHub Actions + FTP

Если не хочешь SSH — настроены секреты `BEGET_FTP_*`, деплой при `git push` или **Actions → Deploy to Beget → Run workflow**.

FTP менее надёжен; **рекомендуется SSH + git pull**.

---

## Cookie-баннер (БД)

Текст GDPR-плагина в базе — после деплоя проверь ссылки на `/wp-content/documents/...` в админке WP или обнови вручную.
