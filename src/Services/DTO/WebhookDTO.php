<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\DTO;

use Carbon\CarbonImmutable;

final readonly class WebhookDTO
{
    public function __construct(
        public string $provider,
        public string $eventId,
        public string $eventType,
        public CarbonImmutable $occuredAt,
        public array $payload
    ) {}
}
