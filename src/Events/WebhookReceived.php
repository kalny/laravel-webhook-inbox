<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Events;

final class WebhookReceived
{
    public function __construct(
        public int $webhookEventId
    ) {}
}
