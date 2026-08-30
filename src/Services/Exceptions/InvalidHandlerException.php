<?php

declare(strict_types=1);

namespace Kalny\LaravelWebhookInbox\Services\Exceptions;

use Illuminate\Http\JsonResponse;
use RuntimeException;

class InvalidHandlerException extends RuntimeException
{
    protected $message = 'Invalid handler';

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 400);
    }
}
