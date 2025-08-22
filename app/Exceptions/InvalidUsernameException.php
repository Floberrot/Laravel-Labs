<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidUsernameException extends Exception
{
    public function __construct(private string $username)
    {
        parent::__construct('Username is wrong : ' . $username, 422);
    }

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return ['username' => $this->username];
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'error'   => $this->getMessage(),
            'context' => $this->context(),
        ], 422);
    }
}
