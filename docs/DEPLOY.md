# Деплой на Beget через Git

Репозиторий: [github.com/bziksv/vipclinik](https://github.com/bziksv/vipclinik)

Обновления на прод заливаются **автоматически** при `git push` в ветку `main`. SSH и FTP-клиент вам не нужны — всё делает GitHub Actions.

## Как это работает

```
Локально: правки → git commit → git push origin main
                              ↓
GitHub Actions: checkout → FTP (FTPS) → Beget public_html
```

В git попадает только то, что реально меняется:
- тема `wp-content/themes/clinic/`
- патч плагина `types` (совместимость с PHP 7.4+)

Ядро WordPress, uploads, кеш и `wp-config.php` на сервере **не трогаются**.

---

## Одноразовая настройка

### 1. FTP-аккаунт на Beget

1. [Панель Beget](https://cp.beget.com/) → **FTP** → **Добавить FTP-аккаунт**
2. Домашняя директория: `vipclinik.com/public_html` (или корень сайта)
3. Запишите: **хост**, **логин**, **пароль**

> Хост обычно вида `vipclinik.beget.tech` или имя из раздела FTP в панели.

### 2. Секреты в GitHub

Репозиторий → **Settings** → **Secrets and variables** → **Actions** → **New repository secret**

| Secret | Пример | Описание |
|--------|--------|----------|
| `BEGET_FTP_HOST` | `vipclinik.beget.tech` | FTP-хост |
| `BEGET_FTP_USER` | `vipclinik_deploy` | Логин FTP |
| `BEGET_FTP_PASSWORD` | `***` | Пароль FTP |
| `BEGET_FTP_REMOTE_DIR` | `/` | Путь от корня FTP-аккаунта до `public_html` |
| `BEGET_FTP_PORT` | `21` | Необязательно |
| `DEPLOY_TOKEN` | `my-secret-deploy-2026` | Ключ для ручного деплоя (см. ниже) |

**`BEGET_FTP_REMOTE_DIR`:** если FTP-аккаунт создан с домашней папкой `public_html`, укажите `/`. Если корень аккаунта выше — укажите `/vipclinik.com/public_html/`.

### 3. Deploy token (ключ без SSH)

`DEPLOY_TOKEN` — произвольная строка, которую знаете только вы. Используется при **ручном** запуске деплоя из GitHub:

1. **Actions** → **Deploy to Beget** → **Run workflow**
2. В поле `confirm` введите значение `DEPLOY_TOKEN`

При обычном `git push` в `main` токен **не нужен** — деплой идёт автоматически.

### 4. Environment (рекомендуется)

**Settings** → **Environments** → **production** → включите **Required reviewers**, если нужно подтверждение перед выкладкой.

---

## Ежедневный workflow

```bash
# правки в теме clinic или других отслеживаемых файлах
git add .
git commit -m "fix: правка шапки сайта"
git push origin main
```

Через 1–3 минуты проверьте:
- **Actions** → последний workflow (зелёная галочка)
- https://vipclinik.com

---

## Ручной деплой

GitHub → **Actions** → **Deploy to Beget** → **Run workflow** → в `confirm` введите `DEPLOY_TOKEN`.

---

## Что не деплоится

| Файл / папка | Причина |
|--------------|---------|
| `wp-config.php` | секреты, уже на сервере |
| `wp-config-local.php` | только для localhost |
| `wp-content/uploads/` | медиафайлы (~1.5 GB) |
| `wp-content/cache/` | генерируется на сервере |
| Ядро WP, плагины | уже на Beget |

---

## Если деплой упал

1. **Actions** → failed job → лог шага FTP
2. Проверьте FTP-логин/пароль в Secrets
3. Проверьте `BEGET_FTP_REMOTE_DIR` — частая ошибка: неверный путь
4. Убедитесь, что FTPS включён для аккаунта (Beget поддерживает)

---

## Альтернатива: rsync по SSH (быстрее)

Если позже включите SSH в панели Beget один раз и добавите ключ — можно переключиться на rsync. Подробнее: [dev-postnov.ru — GitHub Actions + Beget](https://dev-postnov.ru/setup-github-actions/).

Текущая схема через FTP выбрана специально, чтобы **не заходить на сервер по SSH**.
