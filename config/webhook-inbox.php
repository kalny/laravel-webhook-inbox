<?php

return [
    'route' => [
        'prefix' => env('WEBHOOK_PREFIX', 'webhooks'),
        'middleware' => [],
    ],
    'providers' => [
        'paddle' => [
            'webhook_secret' => env('PADDLE_WEBHOOK_SECRET'),
        ],
    ],
];
