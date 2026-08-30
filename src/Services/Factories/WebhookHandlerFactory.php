<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Factories;

use Kalny\LaravelWebhookInbox\Enums\PaymentProvider;
use Kalny\LaravelWebhookInbox\Services\AbstractWebhookHandler;
use Kalny\LaravelWebhookInbox\Services\Exceptions\InvalidHandlerException;

class WebhookHandlerFactory
{
    public function getHandler(PaymentProvider $paymentProvider): AbstractWebhookHandler
    {
        $paymentProviderName = $paymentProvider->value;

        $handlerClassName = config(
            "webhook-inbox.providers.$paymentProviderName.handler",
            null
        );

        if (! $handlerClassName || ! class_exists($handlerClassName)) {
            throw new InvalidHandlerException;
        }

        if (
            ! class_exists($handlerClassName)
            || ! is_subclass_of($handlerClassName, AbstractWebhookHandler::class)
        ) {
            throw new InvalidHandlerException;
        }

        return app($handlerClassName);
    }
}
