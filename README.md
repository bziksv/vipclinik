# vipclinik

Сайт [vipclinik.com](https://vipclinik.com) — WordPress-клиника Елены Байбариной.  
Хостинг: **Beget**. Репозиторий: [github.com/bziksv/vipclinik](https://github.com/bziksv/vipclinik).

## Стек

| Компонент | Версия / детали |
|-----------|-----------------|
| CMS | WordPress 5.0.27 |
| PHP (prod) | 7.x–8.x на Beget |
| PHP (local) | 7.4 (`php@7.4`) |
| БД | MySQL, `vipclinik_s` |
| Тема | `wp-content/themes/clinic` (кастомная, WooCommerce) |
| Кеш | WP Super Cache |
| SSL | Really Simple SSL |

## Структура репозитория

```
vipclinik/
├── README.md                 ← вы здесь
├── docs/
│   ├── LOCAL.md              ← локальный запуск
│   └── DEPLOY.md               ← деплой на Beget через Git
├── .github/workflows/
│   └── deploy-beget.yml        ← GitHub Actions → FTP
├── start-local.sh              ← запуск localhost:8888
├── router.php
├── vipclinik_s.sql.gz          ← дамп БД (не в git, только локально)
└── vipclinik.com/              ← корень WordPress на сервере
    ├── wp-config.example.php
    ├── wp-config-local.php     ← только локально (gitignore)
    └── wp-content/
        └── themes/clinic/      ← основной код в git
```

> Полный сайт (~6 GB с uploads) **не хранится в Git**. В репозитории — тема и патчи; ядро WP и медиа остаются на Beget.

## Быстрый старт

### Локально

```bash
gunzip -c vipclinik_s.sql.gz | mysql -u root vipclinik_s
./start-local.sh
# → http://localhost:8888
```

Подробнее: [docs/LOCAL.md](docs/LOCAL.md)

### Деплой на прод

```bash
git push origin main   # GitHub Actions зальёт изменения на Beget по FTP
```

Одноразовая настройка FTP-секретов: [docs/DEPLOY.md](docs/DEPLOY.md)

## Git workflow

```bash
git checkout -b feature/my-change
# правки в vipclinik.com/wp-content/themes/clinic/
git commit -am "feat: ..."
git push origin feature/my-change
# → Pull Request → merge в main → автодеплой
```

## Секреты и безопасность

**Не коммитить:**
- `wp-config.php` (пароли БД)
- `wp-config-local.php`
- `vipclinik_s.sql.gz`

FTP-пароль и deploy-токен — только в **GitHub Secrets** ([docs/DEPLOY.md](docs/DEPLOY.md)).

## Плагины (основные)

- WooCommerce + Saphali Lite
- Contact Form 7, Yoast SEO, WP Super Cache
- Types (Toolset), NextGEN Gallery, Popup Maker
- Really Simple SSL, GDPR Cookie Compliance

## Поддержка

- Beget KB: [доступ к серверам (FTP/SSH)](https://beget.com/ru/kb/faq/hosting/dostup-k-serveram)
- GitHub Actions деплой: [docs/DEPLOY.md](docs/DEPLOY.md)
