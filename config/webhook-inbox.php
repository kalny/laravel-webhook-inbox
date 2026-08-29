<?php

return [
    'providers' => [
        'paddle' => [
            'webhook_secret' => env('PADDLE_WEBHOOK_SECRET'),
        ],
    ],
];
