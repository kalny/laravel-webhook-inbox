<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services;

use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Enums\WebhookEventStatus;
use Kalny\LaravelWebhookInbox\Events\WebhookReceived;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;
use Kalny\LaravelWebhookInbox\Services\Factories\WebhookAdapterFactory;

class WebhookReceiver
{
    public function __construct(
        private WebhookAdapterFactory $webhookAdapterFactory
    ) {}

    public function receive(PaymentProvider $provider, array $payload): void
    {
        $webhookAdapter = $this->webhookAdapterFactory->getAdapter($provider);

        $webhook = $webhookAdapter->getWebhook($payload);

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
