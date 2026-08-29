<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Paddle;

use Carbon\CarbonImmutable;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\DTO\WebhookDTO;
use Kalny\LaravelWebhookInbox\Services\WebhookAdapter;

class PaddleWebhookAdapter implements WebhookAdapter
{
    public function getWebhook(array $payload): WebhookDTO
    {
        return new WebhookDTO(
            provider: PaymentProvider::Paddle,
            eventId: $payload['event_id'],
            eventType: $payload['event_type'],
            occuredAt: CarbonImmutable::parse($payload['occurred_at']),
            payload: $payload
        );
    }
}
