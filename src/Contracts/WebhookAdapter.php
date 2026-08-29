<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Contracts;

use Kalny\LaravelWebhookInbox\Services\DTO\WebhookDTO;

interface WebhookAdapter
{
    public function getWebhook(array $payload): WebhookDTO;
}
