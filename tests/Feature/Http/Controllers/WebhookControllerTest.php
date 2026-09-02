<?php

use Illuminate\Support\Facades\Event;
use Kalny\LaravelWebhookInbox\Events\WebhookReceived;
use Kalny\LaravelWebhookInbox\Services\Reference\ReferenceWebhookHandler;
use Kalny\LaravelWebhookInbox\Tests\Fixtures\PaddleTransactionCompletedWebhookBuilder;
use Kalny\LaravelWebhookInbox\Tests\Fixtures\ReferenceTransactionCompletedWebhookBuilder;

it('successfully stores a valid paddle webhook', function () {
    Event::fake();

    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $headers = $payloadBuilder->signedHeaders();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();

    $this->assertDatabaseHas('webhook_events', [
        'event_id' => 'evt_123',
    ]);

    Event::assertDispatched(WebhookReceived::class);
});

it('rejects a paddle webhook with an invalid signature', function () {
    Event::fake();

    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();

    $this->postJson('/webhooks/paddle', $payload)
        ->assertBadRequest();

    Event::assertNotDispatched(WebhookReceived::class);
});

it('rejects a webhook with an invalid provider', function () {
    Event::fake();

    $this->postJson('/webhooks/wrong')
        ->assertBadRequest();

    Event::assertNotDispatched(WebhookReceived::class);
});

it('does not create a second record when re-using a webhook', function () {
    Event::fake();

    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $headers = $payloadBuilder->signedHeaders();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();

    $this->assertDatabaseCount('webhook_events', 1);

    Event::assertDispatchedTimes(WebhookReceived::class, 1);
});

it('successfully stores a reference webhook', function () {
    Event::fake();

    config()->set('webhook-inbox.providers.reference.handler', ReferenceWebhookHandler::class);

    $payloadBuilder = new ReferenceTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $headers = $payloadBuilder->signedHeaders();

    $this->postJson('/webhooks/reference', $payload, $headers)
        ->assertOk();

    $this->assertDatabaseHas('webhook_events', [
        'event_id' => 'rf_123',
    ]);

    Event::assertDispatched(WebhookReceived::class);
});
