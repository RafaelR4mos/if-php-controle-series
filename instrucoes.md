# Rafael Ramos | Task Tracker

## Trabalho 1 - PI3

### 📋 Requisitos

Antes de rodar o projeto, certifique-se de ter instalado:

-   PHP 8.1 ou superior
-   Composer
-   MySQL
-   Node.js e npm (opcional, apenas para recursos frontend como Vite)

### Orientações Para utilizar o projeto

1. **Instale as dependências PHP**

    No terminal, dentro da pasta do projeto, rode:

    ```bash
    composer install
    ```

2. Utilize como base o seguinte arquivo `.env`:

```php
APP_NAME="Tasks Tracker"
APP_ENV=local
APP_KEY=base64:vWmXWQWLPjWWNUU2tPIidJVVBHUduRWJYsF+shJKDIY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=pt
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasks
DB_USERNAME=admin
DB_PASSWORD=mysql

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

3. Configure o banco de dados. Suba o banco mysql zerado no Xampp/Docker

4. Rode o comando para executar as migrations e criar as tabelas no banco

```bash
    php artisan migrate
```

5. Rode os seeders para utilizar para criar um usuário e tasks vinculadas a ele.

```bash
    php artisan db:seed
```

6. Instale as dependências frontend e rode o vite. Rode um comando por vez.

```bash
npm install
npm run dev
```
