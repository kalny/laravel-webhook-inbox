<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\DTO;

use Carbon\CarbonImmutable;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;

final readonly class WebhookDTO
{
    public function __construct(
        public PaymentProvider $provider,
        public string $eventId,
        public string $eventType,
        public CarbonImmutable $occuredAt,
        public array $payload
    ) {}
}
