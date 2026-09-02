<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Reference;

use Carbon\CarbonImmutable;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\AbstractWebhookHandler;
use Kalny\LaravelWebhookInbox\Services\DTO\WebhookDTO;

class ReferenceWebhookHandler extends AbstractWebhookHandler
{
    public function getWebhook(array $payload): WebhookDTO
    {
        return new WebhookDTO(
            provider: PaymentProvider::Reference,
            eventId: $payload['event_id'],
            eventType: $payload['event_type'],
            occuredAt: CarbonImmutable::parse($payload['occurred_at']),
            payload: $payload
        );
    }
}
