<?php

namespace AmeMerchant\Exceptions;

use Throwable;

class AmeMerchantSdkException extends \RuntimeException implements AmeMerchantExceptionInterface
{
    private $error;
    private $errorDescription;
    private $statusCode;

    public function __construct(string $error, string $errorDescription, int $statusCode, Throwable $previous = null)
    {
        $this->error = $error;
        $this->errorDescription = $errorDescription;
        $this->statusCode = $statusCode;

        parent::__construct($this->errorDescription, $this->statusCode, $previous);
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getErrorDescription(): string
    {
        return $this->errorDescription;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
