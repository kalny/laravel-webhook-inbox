<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Exceptions;

use Illuminate\Http\JsonResponse;
use RuntimeException;

class InvalidPaymentProviderException extends RuntimeException
{
    protected $message = 'Invalid payment provider';

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 400);
    }
}
