<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController
{
    public function __invoke(Request $request, string $provider): JsonResponse
    {
        return response()->json([
            'provider' => $provider,
        ]);
    }
}
