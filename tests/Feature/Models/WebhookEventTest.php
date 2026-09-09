<?php

use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;
use Kalny\LaravelWebhookInbox\Tests\Fixtures\PaddleTransactionCompletedWebhookBuilder;

it('can create a webhook event', function () {
    $event = WebhookEvent::factory()->create([
        'payload' => (new PaddleTransactionCompletedWebhookBuilder())->build()
    ]);

    expect($event)
        ->toBeInstanceOf(WebhookEvent::class)
        ->and($event->provider)->toBe(PaymentProvider::Paddle)
        ->and($event->event_id)->toBe('evt_123');
});
