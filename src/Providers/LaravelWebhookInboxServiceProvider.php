<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelWebhookInboxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/webhook-inbox.php',
            'webhook-inbox',
        );
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__.'/../database/migrations'
        );
    }
}
