<?php

namespace App\Exceptions;

use App\Helpers\JResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InternalErrorException extends Exception
{
    public array $errors;

    public function __construct(string $message = '', array $errors = [], int $status = Response::HTTP_BAD_REQUEST)
    {
        $this->errors = $errors;
        parent::__construct($message, $status);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Render the exception.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return JResponse::error($this->getMessage(), $this->getErrors(), $this->getCode());
    }
}
