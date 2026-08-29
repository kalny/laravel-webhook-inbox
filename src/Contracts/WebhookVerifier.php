<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Contracts;

use Illuminate\Http\Request;

interface WebhookVerifier
{
    public function verify(Request $request): bool;
}
