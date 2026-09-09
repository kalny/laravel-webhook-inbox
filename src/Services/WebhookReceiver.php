<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services;

use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Enums\WebhookEventStatus;
use Kalny\LaravelWebhookInbox\Events\WebhookReceived;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;
use Kalny\LaravelWebhookInbox\Services\Factories\WebhookHandlerFactory;

class WebhookReceiver
{
    public function __construct(
        private WebhookHandlerFactory $webhookHandlerFactory
    ) {}

    public function receive(string $provider, Request $payload): void
    {
        $webhookHandler = $this->webhookHandlerFactory->getHandler($provider);

        $webhook = $webhookHandler->handle($payload);

        $event = WebhookEvent::firstOrCreate(
            [
                'provider' => $webhook->provider,
                'event_id' => $webhook->eventId,
            ],
            [
                'event_type' => $webhook->eventType,
                'occurred_at' => $webhook->occuredAt,
                'payload' => $webhook->payload,
                'status' => WebhookEventStatus::Pending,
            ],
        );

        if ($event->wasRecentlyCreated) {
            event(new WebhookReceived($event->id));
        }
    }
}
