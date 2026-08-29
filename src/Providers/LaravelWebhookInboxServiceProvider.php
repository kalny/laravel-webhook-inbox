<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Kalny\LaravelWebhookInbox\Http\Controllers\WebhookController;

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
            __DIR__.'/../../database/migrations'
        );

        Route::prefix(config('webhook-inbox.route.prefix'))
            ->middleware(config('webhook-inbox.route.middleware'))
            ->group(function () {
                Route::post(
                    '/{provider}',
                    WebhookController::class
                );
            });
    }
}
