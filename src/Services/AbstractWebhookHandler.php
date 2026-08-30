<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services;

use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Contracts\WebhookHandler;
use Kalny\LaravelWebhookInbox\Services\DTO\WebhookDTO;

abstract class AbstractWebhookHandler implements WebhookHandler
{
    public function handle(Request $request): WebhookDTO
    {
        if (! $this->verify($request)) {
            abort(400, 'Invalid signature');
        }

        return $this->getWebhook($request->all());
    }

    public function verify(Request $request): bool
    {
        return true;
    }

    abstract public function getWebhook(array $payload): WebhookDTO;
}
