<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Factories;

use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\Exceptions\InvalidPaymentProviderException;
use Kalny\LaravelWebhookInbox\Services\Paddle\PaddleWebhookVerifier;
use Kalny\LaravelWebhookInbox\Services\WebhookVerifier;

class WebhookVerifierFactory
{
    public function getVerifier(?PaymentProvider $paymentProvider): WebhookVerifier
    {
        return match ($paymentProvider) {
            PaymentProvider::Paddle => app(PaddleWebhookVerifier::class),
            default => throw new InvalidPaymentProviderException
        };
    }
}
