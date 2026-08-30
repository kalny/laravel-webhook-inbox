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
            'handler' => 'Kalny\\LaravelWebhookInbox\\Services\\Paddle\\PaddleWebhookHandler',
        ],
    ],
];
