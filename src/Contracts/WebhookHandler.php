<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Contracts;

use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Services\DTO\WebhookDTO;

interface WebhookHandler
{
    public function verify(Request $request): bool;

    public function getWebhook(array $payload): WebhookDTO;
}
