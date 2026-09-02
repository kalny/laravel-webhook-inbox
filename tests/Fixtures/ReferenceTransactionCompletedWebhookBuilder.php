<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Tests\Fixtures;

use Carbon\CarbonImmutable;

class ReferenceTransactionCompletedWebhookBuilder
{
    private array $payload;

    public function __construct()
    {
        $nowString = CarbonImmutable::now('UTC')->toISOString();

        $this->payload = [
            'event_id' => 'rf_123',
            'event_type' => 'transaction.completed',
            'occurred_at' => $nowString,
            'notification_id' => 'ntf_123',
        ];
    }

    public function build(): array
    {
        return $this->payload;
    }

    public function signedHeaders(): array
    {
        $timestamp = time();
        $body = json_encode($this->payload, JSON_THROW_ON_ERROR);

        $signature = hash_hmac(
            'sha256',
            "$timestamp:$body",
            config('webhook-inbox.providers.paddle.webhook_secret')
        );

        return [
            'Paddle-Signature' => "ts=$timestamp;h1=$signature",
        ];
    }
}
