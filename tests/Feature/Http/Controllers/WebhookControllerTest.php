<?php

use Kalny\LaravelWebhookInbox\Tests\Fixtures\PaddleTransactionCompletedWebhookBuilder;

it('successfully receive paddle webhook', function () {
    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $headers = $payloadBuilder->signedHeaders();

    $this->postJson('/webhooks/paddle', $payload, $headers)
        ->assertOk();
});

it('try receive paddle webhook with incorrect signature', function () {
    $payloadBuilder = new PaddleTransactionCompletedWebhookBuilder;
    $payload = $payloadBuilder->build();
    $this->postJson('/webhooks/paddle', $payload)
        ->assertBadRequest();
});

it('try receive paddle webhook with incorrect provider', function () {
    $this->postJson('/webhooks/wrong')
        ->assertBadRequest();
});
