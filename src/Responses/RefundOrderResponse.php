<?php

namespace AmeMerchant\Responses;

use JsonSerializable;

/**
 * Class RefundOrderResponse
 * @package AmeMerchant\Responses
 */
class RefundOrderResponse implements JsonSerializable
{
    /** @var string */
    private $refundId;

    /** @var string */
    private $operationId;

    /** @var int */
    private $amount;

    /** @var string */
    private $status;

    /** @var string */
    private $createdAt;

    /** @var string */
    private $refundedAt;

    /**
     * LoginResponse constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        foreach ($values as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);

        return array_filter($vars, static function ($value) {
            return $value !== null;
        });
    }

    /**
     * @return string
     */
    public function getRefundId(): string
    {
        return $this->refundId;
    }

    /**
     * @return string
     */
    public function getOperationId(): string
    {
        return $this->operationId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getRefundedAt(): string
    {
        return $this->refundedAt;
    }
}
