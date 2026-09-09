<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Services\WebhookReceiver;

class WebhookController
{
    public function __invoke(
        string $provider,
        Request $request,
        WebhookReceiver $webhookReceiver
    ): JsonResponse {
        $webhookReceiver->receive($provider, $request);

        return response()->json(['ok']);
    }
}
