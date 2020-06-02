<?php

namespace AmeMerchant\Response;

use AmeMerchant\Data\Attribute;

/**
 * Class VerifyOrderResponse
 * @package AmeMerchant\Response
 */
class CancelOrderResponse extends VerifyOrderResponse
{
    /** @var int */
    protected $nsu;

    /** @var string */
    protected $operationType;

    /** @var string */
    protected $cashType;

    /** @var int */
    protected $amountRefunded;

    /** @var array */
    protected $splits;

    /** @var array */
    protected $peer;

    /**
     * @return int
     */
    public function getNsu(): int
    {
        return $this->nsu;
    }

    /**
     * @return string
     */
    public function getOperationType(): string
    {
        return $this->operationType;
    }

    /**
     * @return string
     */
    public function getCashType(): string
    {
        return $this->cashType;
    }

    /**
     * @return int
     */
    public function getAmountRefunded(): int
    {
        return $this->amountRefunded;
    }

    /**
     * @return array
     */
    public function getSplits(): array
    {
        return $this->splits;
    }

    /**
     * @return array
     */
    public function getPeer(): array
    {
        return $this->peer;
    }
}
