<?php

namespace AmeMerchant\Responses;

use AmeMerchant\Data\Attribute;
use JsonSerializable;

/**
 * Class VerifyOrderResponse
 * @package AmeMerchant\Responses
 */
class VerifyOrderResponse implements JsonSerializable
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $ownerId;

    /** @var string */
    protected $creditWalletId;

    /** @var string */
    protected $ttl;

    /** @var string */
    protected $date;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var int */
    protected $amount;

    /** @var string */
    protected $currency;

    /** @var string */
    protected $type;

    /** @var Attribute */
    protected $attributes;

    /** @var array */
    protected $planTypes;

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
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @return string
     */
    public function getCreditWalletId(): string
    {
        return $this->creditWalletId;
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
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function getPlanTypes(): array
    {
        return $this->planTypes;
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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Attribute
     */
    public function getAttributes(): Attribute
    {
        return $this->attributes;
    }
}
