<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\WebhookVerifierFactory;

class WebhookController
{
    public function __invoke(
        string $provider,
        Request $request,
        WebhookVerifierFactory $verifierFactory
    ): JsonResponse {
        $verifier = $verifierFactory->getVerifier(
            PaymentProvider::tryFrom($provider)
        );

        if (! $verifier->verify($request)) {
            abort(400, 'Invalid signature');
        }

        return response()->json(['ok']);
    }
}
