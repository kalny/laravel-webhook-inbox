<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Tests\Fixtures;

use Carbon\CarbonImmutable;

class PaddleTransactionCompletedWebhookBuilder
{
    private array $payload;

    public function __construct()
    {
        $nowString = CarbonImmutable::now('UTC')->toISOString();

        $this->payload = [
            'event_id' => 'evt_123',
            'event_type' => 'transaction.completed',
            'occurred_at' => $nowString,
            'notification_id' => 'ntf_123',
            'data' => [
                'id' => 'txn_123',
                'customer_id' => 'ctm_123',
                'subscription_id' => 'sub_123',
                'status' => 'completed',
                'billed_at' => $nowString,
                'details' => [
                    'totals' => [
                        'subtotal' => '750',
                        'tax' => '150',
                        'total' => '900',
                        'fee' => '95',
                        'earnings' => '655',
                        'currency_code' => 'USD',
                    ],
                ],
                'payments' => [
                    [
                        'payment_attempt_id' => 'payment-attempt-id',
                        'status' => 'authorized',
                        'amount' => '900',
                        'payment_method_id' => 'paymtd_123',
                        'method_details' => [
                            'card' => [
                                'last4' => '4242',
                            ],
                        ],
                        'captured_at' => $nowString,
                    ],
                ],
                'custom_data' => [
                    'user_id' => 1,
                ],
            ],
        ];
    }

    public function build(): array
    {
        return $this->payload;
    }

    public function withoutTransactionId(): self
    {
        unset($this->payload['data']['id']);

        return $this;
    }

    public function withoutUserId(): self
    {
        unset($this->payload['data']['custom_data']['user_id']);

        return $this;
    }

    public function withoutCustomerId(): self
    {
        unset($this->payload['data']['customer_id']);

        return $this;
    }

    public function withoutSubscriptionId(): self
    {
        unset($this->payload['data']['subscription_id']);

        return $this;
    }

    public function withCurrency(string $currency): self
    {
        $this->payload['data']['details']['totals']['currency_code'] = $currency;

        return $this;
    }

    public function withStatus(string $status): self
    {
        $this->payload['data']['status'] = $status;

        return $this;
    }

    public function withPaymentStatus(string $status): self
    {
        $this->payload['data']['payments'][0]['status'] = $status;

        return $this;
    }

    public function signedHeaders(): array
    {
        $timestamp = time();
        $body = json_encode($this->payload, JSON_THROW_ON_ERROR);

        $signature = hash_hmac(
            'sha256',
            "$timestamp:$body",
            config('webhook-inbox.providers.paddle.webhook_secret')
        );

        return [
            'Paddle-Signature' => "ts=$timestamp;h1=$signature",
        ];
    }
}
