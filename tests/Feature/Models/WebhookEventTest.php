<?php

use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;

it('can create a webhook event', function () {
    $event = WebhookEvent::factory()->create();

    expect($event)
        ->toBeInstanceOf(WebhookEvent::class)
        ->and($event->provider)->toBe(PaymentProvider::Paddle)
        ->and($event->event_id)->toBe('evt_123');
});
