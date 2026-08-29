<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services;

use Illuminate\Http\Request;

interface WebhookVerifier
{
    public function verify(Request $request): bool;
}
