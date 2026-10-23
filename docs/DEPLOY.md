# Деплой vipclinik.com на Beget

Репозиторий: [github.com/bziksv/vipclinik](https://github.com/bziksv/vipclinik)

## Схема (как billiard.guru)

```
Mac: правки → git commit → git push origin main
                              ↓
Beget SSH: cd ~/vipclinik && ./scripts/beget-deploy.sh
                              ↓
         файлы на public_html + синхронизация БД
```

На сервере **нет** `git pull` в `public_html`. Git-репозиторий лежит отдельно:

| Путь на Beget | Назначение |
|---------------|------------|
| `~/vipclinik` | git-репозиторий с GitHub |
| `~/vipclinik.com/public_html` | живой сайт WordPress |

---

## Каждый деплой

### Mac

```bash
cd /Users/stanislav/Documents/projects/vipclinik

git status

git add .gitignore router.php scripts/ vipclinik.com/.htaccess \
  vipclinik.com/wp-content/documents/ \
  vipclinik.com/wp-content/themes/clinic/

git commit -m "кратко: что изменил"
git push origin main
```

### Beget (SSH)

```bash
cd ~/vipclinik && ./scripts/beget-deploy.sh
```

Скрипт сам делает `git pull`, копирует файлы и запускает **`db-sync.php`**.

Ожидаемый вывод:

```
→ wp-content/themes/clinic
→ wp-content/documents
→ .htaccess
→ database sync
  moove_gdpr_info_bar_content — обновлён
✓ DB sync готово
✓ Готово: https://vipclinik.com
```

### Проверка

- https://vipclinik.com/wp-content/documents/consent.pdf — PDF открывается
- https://vipclinik.com/ — cookie-баннер и формы со ссылками на `/wp-content/documents/...`

---

## Одноразовая настройка на Beget

### 1. SSH

Панель Beget → **SSH** → включить.

### 2. Клон репозитория

```bash
ssh vipclinik_admin@vipclinik.beget.tech

cd ~
git clone https://github.com/bziksv/vipclinik.git vipclinik
cd vipclinik
chmod +x scripts/*.sh
```

### 3. Путь к сайту (рекомендуется прописать в профиле)

```bash
echo 'export BEGET_WEB=$HOME/vipclinik.com/public_html' >> ~/.bashrc
source ~/.bashrc
```

Если `public_html` в другом месте:

```bash
export BEGET_WEB=/home/USER/vipclinik.com/public_html
```

### 4. Первый деплой

```bash
cd ~/vipclinik
./scripts/beget-deploy.sh
```

---

## Что выкладывается

| Из git | Куда на сервере |
|--------|-----------------|
| `vipclinik.com/wp-content/themes/clinic/` | тема |
| `vipclinik.com/wp-content/documents/` | PDF политики |
| `vipclinik.com/.htaccess` | редиректы PDF, исключение `documents/` |
| `vipclinik.com/wp-content/plugins/types/.../adodb-time.inc.php` | патч PHP 7.4 |
| `scripts/db/gdpr-infobar.html` | → в БД через `db-sync.php` |

**Не трогаем:** `uploads/`, `wp-config.php`, ядро WP, остальные плагины.

---

## Что править и где (чтобы попало на прод)

| Задача | Файл в git | Попадает на прод через |
|--------|------------|------------------------|
| Тема, футер, формы (JS) | `wp-content/themes/clinic/` | копирование файлов |
| PDF политики | `wp-content/documents/*.pdf` | копирование файлов |
| Cookie-баннер (текст) | `scripts/db/gdpr-infobar.html` | `db-sync.php` → БД |
| Ссылки на PDF в формах (на сайте) | `themes/clinic/js/main.js` | копирование + JS на фронте |
| Редиректы со старых URL PDF | `vipclinik.com/.htaccess` | копирование |
| Старые URL в БД (страницы, опции) | `scripts/db-sync.php` | автоматически при деплое |

### URL документов на проде

| Документ | URL |
|----------|-----|
| Cookies | `/wp-content/documents/cookies.pdf` |
| Согласие ПДн | `/wp-content/documents/consent.pdf` |
| Политика ПДн | `/wp-content/documents/personal-data.pdf` |
| Рек. технологии | `/wp-content/documents/rules-recommendation.pdf` |

Со старых путей (`uploads/2026/...`, длинные имена) — 301 в `.htaccess`.

---

## Синхронизация БД (`db-sync.php`)

Запускается автоматически в `./scripts/beget-setup.sh`, если есть `wp-load.php`.

Вручную на Beget:

```bash
cd ~/vipclinik
BEGET_WEB=$HOME/vipclinik.com/public_html php scripts/db-sync.php
```

Локально (протестировать перед деплоем):

```bash
cd /Users/stanislav/Documents/projects/vipclinik
BEGET_WEB="$(pwd)/vipclinik.com" php scripts/db-sync.php
```

**Делает:**
- обновляет `moove_gdpr_info_bar_content` из `scripts/db/gdpr-infobar.html`;
- заменяет старые URL PDF в `wp_options`, `wp_posts`, `wp_postmeta`;
- сбрасывает кеш transients GDPR-плагина.

**Формы CF7:** в админке в шаблоне чекбокса может быть `"1"` — на сайте текст подменяет `main.js` из темы (деploy файлов).

---

## Скрипты

| Скрипт | Назначение |
|--------|------------|
| `scripts/beget-deploy.sh` | `git pull` + `beget-setup.sh` |
| `scripts/beget-setup.sh` | копирование файлов + `db-sync.php` |
| `scripts/db-sync.php` | обновление БД |
| `scripts/beget-lib.sh` | путь `BEGET_WEB` |

Только файлы, без pull:

```bash
cd ~/vipclinik && ./scripts/beget-setup.sh
```

---

## Локальная разработка

```bash
cd /Users/stanislav/Documents/projects/vipclinik
./start-local.sh
```

→ http://localhost:8888

Порт занят:

```bash
kill $(lsof -t -i:8888) && ./start-local.sh
```

Подробнее: [LOCAL.md](LOCAL.md)

---

## Альтернатива: GitHub Actions + FTP

Workflow `.github/workflows/deploy-beget.yml` — деплой по FTP при `git push`.

Требует секреты `BEGET_FTP_*` в GitHub. **Основная схема — SSH + `beget-deploy.sh`**, FTP — запасной вариант.

---

## Если что-то пошло не так

| Проблема | Решение |
|----------|---------|
| PDF 404 | `./scripts/beget-deploy.sh`, проверить `~/vipclinik.com/public_html/wp-content/documents/` |
| Старый текст cookie-баннера | править `scripts/db/gdpr-infobar.html` → push → deploy; или `php scripts/db-sync.php` |
| Старые ссылки в формах на сайте | проверить `themes/clinic/js/main.js` задеплоился |
| `BEGET_WEB` не найден | `export BEGET_WEB=$HOME/vipclinik.com/public_html` |
| `git pull` конфликт | `git stash` → pull → stash pop, или разобрать конфликт вручную |
