<?php

namespace Kalny\LaravelWebhookInbox\Database\Factories;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Enums\WebhookEventStatus;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;
use Kalny\LaravelWebhookInbox\Tests\Fixtures\PaddleTransactionCompletedWebhookBuilder;

/**
 * @extends Factory<WebhookEvent>
 */
class WebhookEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'provider' => PaymentProvider::Paddle,
            'event_id' => 'evt_123',
            'event_type' => 'payment.succeeded',
            'occurred_at' => CarbonImmutable::now(),
            'payload' => (new PaddleTransactionCompletedWebhookBuilder())->build(),
            'status' => WebhookEventStatus::Pending,
        ];
    }
}
