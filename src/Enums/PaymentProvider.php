<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Enums;

enum PaymentProvider: string
{
    case Paddle = 'paddle';
}
