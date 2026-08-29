<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Factories;

use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\Exceptions\InvalidPaymentProviderException;
use Kalny\LaravelWebhookInbox\Services\Paddle\PaddleWebhookAdapter;
use Kalny\LaravelWebhookInbox\Services\WebhookAdapter;

class WebhookAdapterFactory
{
    public function getAdapter(?PaymentProvider $paymentProvider): WebhookAdapter
    {
        return match ($paymentProvider) {
            PaymentProvider::Paddle => app(PaddleWebhookAdapter::class),
            default => throw new InvalidPaymentProviderException
        };
    }
}
