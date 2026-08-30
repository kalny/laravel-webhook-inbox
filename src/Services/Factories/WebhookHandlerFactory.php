<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Factories;

use Kalny\LaravelWebhookInbox\Contracts\WebhookHandler;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\Exceptions\InvalidPaymentProviderException;
use Kalny\LaravelWebhookInbox\Services\Paddle\PaddleWebhookHandler;

class WebhookHandlerFactory
{
    public function getHandler(?PaymentProvider $paymentProvider): WebhookHandler
    {
        return match ($paymentProvider) {
            PaymentProvider::Paddle => app(PaddleWebhookHandler::class),
            default => throw new InvalidPaymentProviderException
        };
    }
}
