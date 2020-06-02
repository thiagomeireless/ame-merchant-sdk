<?php

namespace AmeMerchant\Exceptions;

use Throwable;

interface AmeMerchantExceptionInterface extends Throwable
{
    public function getError(): string;

    public function getErrorDescription(): string;

    public function getStatusCode(): int;
}
