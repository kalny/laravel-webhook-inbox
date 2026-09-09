<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalny\LaravelWebhookInbox\Database\Factories\WebhookEventFactory;
use Kalny\LaravelWebhookInbox\Enums\WebhookEventStatus;

/**
 * @property int $id
 * @property string $provider
 * @property string $event_id
 * @property string $event_type
 * @property CarbonImmutable $occurred_at
 * @property array $payload
 * @property WebhookEventStatus $status
 * @property int $attempts
 * @property CarbonImmutable|null $processing_started_at
 * @property CarbonImmutable|null $processed_at
 * @property string|null $last_error
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 */
#[Fillable([
    'provider',
    'event_id',
    'event_type',
    'occurred_at',
    'payload',
    'status',
    'attempts',
    'processing_started_at',
    'processed_at',
    'last_error',
])]
#[UseFactory(WebhookEventFactory::class)]
class WebhookEvent extends Model
{
    /** @use HasFactory<WebhookEventFactory> */
    use HasFactory;

    private const MAX_PROCESSING_LIFETIME = 15;

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'occurred_at' => 'datetime',
            'processing_started_at' => 'datetime',
            'processed_at' => 'datetime',
            'status' => WebhookEventStatus::class,
        ];
    }

    public function isPending(): bool
    {
        return $this->status === WebhookEventStatus::Pending;
    }

    public function isProcessing(): bool
    {
        return $this->status === WebhookEventStatus::Processing;
    }

    public function isProcessed(): bool
    {
        return $this->status === WebhookEventStatus::Processed;
    }

    public function isDeadProcessing(): bool
    {
        return $this->isProcessing()
            && $this->processing_started_at !== null
            && $this->processing_started_at
                ->addMinutes(self::MAX_PROCESSING_LIFETIME)
                ->isPast();
    }
}
