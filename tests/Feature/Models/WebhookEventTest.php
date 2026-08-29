<?php

use Carbon\CarbonImmutable;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Enums\WebhookEventStatus;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;

it('can create a webhook event', function () {
    $event = WebhookEvent::create([
        'provider' => PaymentProvider::Paddle,
        'event_id' => 'evt_123',
        'event_type' => 'payment.succeeded',
        'occurred_at' => CarbonImmutable::now(),
        'payload' => [
            'amount' => 1000,
        ],
        'status' => WebhookEventStatus::Pending,
    ]);

    expect($event)
        ->toBeInstanceOf(WebhookEvent::class)
        ->and($event->provider)->toBe(PaymentProvider::Paddle)
        ->and($event->event_id)->toBe('evt_123');
});
