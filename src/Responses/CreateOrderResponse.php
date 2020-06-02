<?php

namespace AmeMerchant\Responses;

use AmeMerchant\Data\Attribute;
use JsonSerializable;

/**
 * Class CreateOrderResponse
 * @package AmeMerchant\Responses
 */
class CreateOrderResponse implements JsonSerializable
{
    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var int */
    private $amount;

    /** @var string */
    private $type;

    /** @var Attribute */
    private $attributes;

    /** @var string */
    private $qrCodeLink;

    /** @var string */
    private $deepLink;

    /**
     * CreateOrderResponse constructor.
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return CreateOrderResponse
     */
    public function setTitle($title): CreateOrderResponse
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CreateOrderResponse
     */
    public function setDescription($description): CreateOrderResponse
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return CreateOrderResponse
     */
    public function setAmount($amount): CreateOrderResponse
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CreateOrderResponse
     */
    public function setType($type): CreateOrderResponse
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Attribute
     */
    public function getAttributes(): Attribute
    {
        return $this->attributes;
    }

    /**
     * @param Attribute $attributes
     * @return CreateOrderResponse
     */
    public function setAttributes($attributes): CreateOrderResponse
    {
        $this->attributes = $attributes;
        return $this;
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
    public function getQrCodeLink(): string
    {
        return $this->qrCodeLink;
    }

    /**
     * @return string
     */
    public function getDeepLink(): string
    {
        return $this->deepLink;
    }
}
