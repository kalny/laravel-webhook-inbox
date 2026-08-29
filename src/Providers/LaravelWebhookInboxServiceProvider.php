<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelWebhookInboxServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__.'/../database/migrations'
        );
    }
}
