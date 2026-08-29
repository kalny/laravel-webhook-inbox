<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services;

use Illuminate\Http\Request;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class RequestAdapter
{
    public function make(Request $request): ServerRequestInterface
    {
        $factory = new Psr17Factory;

        return (new PsrHttpFactory(
            $factory,
            $factory,
            $factory,
            $factory,
        ))->createRequest($request);
    }
}
