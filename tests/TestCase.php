<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Tests;

use Kalny\LaravelWebhookInbox\Providers\LaravelWebhookInboxServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelWebhookInboxServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set(
            'webhook-inbox.providers.paddle.webhook_secret',
            'paddle-test-secret'
        );
    }
}
