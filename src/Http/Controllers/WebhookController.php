<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\Exceptions\InvalidPaymentProviderException;
use Kalny\LaravelWebhookInbox\Services\WebhookReceiver;

class WebhookController
{
    public function __invoke(
        string $provider,
        Request $request,
        WebhookReceiver $webhookReceiver
    ): JsonResponse {
        $paymentProvider = PaymentProvider::tryFrom($provider);

        if (! $paymentProvider) {
            throw new InvalidPaymentProviderException;
        }

        $webhookReceiver->receive($paymentProvider, $request);

        return response()->json(['ok']);
    }
}
