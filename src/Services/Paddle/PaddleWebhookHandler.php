<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Paddle;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Contracts\WebhookHandler;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\DTO\WebhookDTO;
use Kalny\LaravelWebhookInbox\Services\RequestAdapter;
use Paddle\SDK\Notifications\Secret;
use Paddle\SDK\Notifications\Verifier;

class PaddleWebhookHandler implements WebhookHandler
{
    public function __construct(
        private RequestAdapter $adapter
    ) {}

    public function verify(Request $request): bool
    {
        $psrRequest = $this->adapter->make($request);

        $verifier = new Verifier;

        return $verifier->verify(
            $psrRequest,
            new Secret(config('webhook-inbox.providers.paddle.webhook_secret'))
        );
    }

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
