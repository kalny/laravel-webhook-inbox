<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Enums;

enum WebhookEventStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Processed = 'processed';
    case Failed = 'failed';
}
