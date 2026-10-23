# vipclinik

Сайт [vipclinik.com](https://vipclinik.com) — WordPress-клиника Елены Байбариной.  
Хостинг: **Beget**. Репозиторий: [github.com/bziksv/vipclinik](https://github.com/bziksv/vipclinik).

## Стек

| Компонент | Версия / детали |
|-----------|-----------------|
| CMS | WordPress 7.1.3 (локально после апгрейда; прод ещё может быть старым) |
| PHP (prod) | сейчас 5.6 на Beget (нужно менять отдельно) |
| PHP (local) | 8.5 (`php@8.5`, `./start-local.sh`) |
| БД | MySQL, `vipclinik_s` |
| Тема | `wp-content/themes/clinic` |
| Кеш | WP Super Cache |
| SSL | Really Simple SSL |

## Структура репозитория

```
vipclinik/
├── README.md
├── docs/
│   ├── LOCAL.md              ← локальный запуск
│   └── DEPLOY.md             ← деплой на Beget (основное)
├── scripts/
│   ├── beget-deploy.sh       ← git pull + выкладка + БД
│   ├── beget-setup.sh
│   ├── db-sync.php           ← cookie-баннер и URL в БД
│   └── db/gdpr-infobar.html
├── start-local.sh
├── router.php
└── vipclinik.com/
    ├── .htaccess
    └── wp-content/
        ├── documents/        ← PDF политики (в git)
        └── themes/clinic/    ← тема (в git)
```

> Полный сайт с uploads **не в git**. На Beget: git-репо в `~/vipclinik`, сайт в `~/vipclinik.com/public_html`.

## Быстрый старт

### Локально

```bash
gunzip -c vipclinik_s.sql.gz | mysql -u root vipclinik_s
./start-local.sh
# → http://localhost:8888
```

→ [docs/LOCAL.md](docs/LOCAL.md)

### Деплой на прод

**Mac:**
```bash
cd /Users/stanislav/Documents/projects/vipclinik
git add scripts/ vipclinik.com/wp-content/documents/ vipclinik.com/wp-content/themes/clinic/ vipclinik.com/.htaccess
git commit -m "описание"
git push origin main
```

**Beget SSH:**
```bash
cd ~/vipclinik && ./scripts/beget-deploy.sh
```

→ [docs/DEPLOY.md](docs/DEPLOY.md) — полная инструкция

## Что не коммитить

- `wp-config.php`, `wp-config-local.php`
- `vipclinik_s.sql.gz`
- `документы (1)/`, `документы (1).zip` — исходники клиента
- `wp-content/uploads/`

## Плагины (основные)

- WooCommerce, Contact Form 7, Yoast SEO
- GDPR Cookie Compliance (Moove) — текст баннера из git через `db-sync.php`
- Types (Toolset), WP Super Cache, Really Simple SSL
