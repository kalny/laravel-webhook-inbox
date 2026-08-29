<?php

use Kalny\LaravelWebhookInbox\Tests\Fixtures\PaddleTransactionCompletedWebhookBuilder;

it('successfully stores a valid paddle webhook', function () {
    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $headers = $payloadBuilder->signedHeaders();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();

    $this->assertDatabaseHas('webhook_events', [
        'event_id' => 'evt_123',
    ]);
});

it('rejects a paddle webhook with an invalid signature', function () {
    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();

    $this->postJson('/webhooks/paddle', $payload)
        ->assertBadRequest();
});

it('rejects a webhook with an invalid provider', function () {
    $this->postJson('/webhooks/wrong')
        ->assertBadRequest();
});

it('does not create a second record when re-using a webhook', function () {
    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $headers = $payloadBuilder->signedHeaders();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();

    $this->assertDatabaseCount('webhook_events', 1);
});

it('allows the same event ID for different providers')->todo();
