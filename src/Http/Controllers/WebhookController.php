<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\Factories\WebhookHandlerFactory;
use Kalny\LaravelWebhookInbox\Services\WebhookReceiver;

class WebhookController
{
    public function __invoke(
        string $provider,
        Request $request,
        WebhookHandlerFactory $handlerFactory,
        WebhookReceiver $webhookReceiver
    ): JsonResponse {
        $paymentProvider = PaymentProvider::tryFrom($provider);

        $handler = $handlerFactory->getHandler($paymentProvider);

        if (! $handler->verify($request)) {
            abort(400, 'Invalid signature');
        }

        $webhookReceiver->receive($paymentProvider, $request->all());

        return response()->json(['ok']);
    }
}
