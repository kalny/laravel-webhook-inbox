# Webhook processing in a Laravel app

> 🚧 **Work in Progress** — this project is currently under active development.

## Installation

Install the package

```bash
composer require kalny/laravel-webhook-inbox
```

Publish the configuration if you want to override it

```bash
php artisan vendor:publish --tag=webhook-inbox-config
```

The `config/webhook-inbox.php` configuration file will appear

```php
<?php

return [
    'route' => [
        'enabled' => true,
        'prefix' => 'webhooks',
        'middleware' => [],
    ],
    'providers' => [
        'paddle' => [
            'webhook_secret' => env('PADDLE_WEBHOOK_SECRET'),
        ],
    ],
];
```

Add environment variables to the `.env` file

```bash
PADDLE_WEBHOOK_SECRET=
```

Run migrations

```bash
php artisan migrate
```