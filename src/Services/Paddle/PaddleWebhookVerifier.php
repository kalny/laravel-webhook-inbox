<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Paddle;

use Illuminate\Http\Request;
use Kalny\LaravelWebhookInbox\Contracts\WebhookVerifier;
use Kalny\LaravelWebhookInbox\Services\RequestAdapter;
use Paddle\SDK\Notifications\Secret;
use Paddle\SDK\Notifications\Verifier;

class PaddleWebhookVerifier implements WebhookVerifier
{
    public function __construct(
        private RequestAdapter $adapter
    ) {}

    public function verify(Request $request): bool
    {
        $psrRequest = $this->adapter->make($request);

        $verifier = new Verifier;

        return $verifier->verify(
            $psrRequest,
            new Secret(config('webhook-inbox.providers.paddle.webhook_secret'))
        );
    }
}
