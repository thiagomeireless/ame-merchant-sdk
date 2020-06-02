<?php

namespace AmeMerchant\Responses;

use AmeMerchant\Data\Attribute;
use JsonSerializable;

/**
 * Class CancelOrderResponse
 * @package AmeMerchant\Responses
 */
class CaptureOrderResponse implements JsonSerializable
{
    /** @var string */
    private $id;

    /** @var int */
    private $nsu;

    /** @var string */
    private $ttl;

    /** @var string */
    private $date;

    /** @var string */
    private $operationType;

    /** @var string */
    private $name;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $status;

    /** @var string */
    private $type;

    /** @var string */
    private $currency;

    /** @var string */
    private $cashType;

    /** @var int */
    private $amount;

    /** @var int */
    private $amountRefunded;

    /** @var array */
    private $splits;

    /** @var Attribute */
    private $attributes;

    /** @var array */
    private $peer;

    /** @var string */
    private $qrCodeLink;

    /**
     * VerifyOrderResponse constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        foreach ($values as $property => $value) {
            if (property_exists($this, $property)) {
                if ($property === 'attributes') {
                    $this->{$property} = Attribute::createFromArray($value);
                } else {
                    $this->{$property} = $value;
                }
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
     * @return int
     */
    public function getNsu(): int
    {
        return $this->nsu;
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTtl(): string
    {
        return $this->ttl;
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
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return Attribute
     */
    public function getAttributes(): Attribute
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function getQrCodeLink(): string
    {
        return $this->qrCodeLink;
    }
}
