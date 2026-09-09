<?php

namespace Kalny\LaravelWebhookInbox\Database\Factories;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Kalny\LaravelWebhookInbox\Enums\WebhookEventStatus;
use Kalny\LaravelWebhookInbox\Models\WebhookEvent;

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
            'provider' => 'paddle',
            'event_id' => 'evt_123',
            'event_type' => 'transaction.completed',
            'occurred_at' => CarbonImmutable::now(),
            'payload' => [],
            'status' => WebhookEventStatus::Pending,
        ];
    }
}
