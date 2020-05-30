<?php

namespace AmeMerchant\Data;

use JsonSerializable;

class Order implements JsonSerializable
{
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
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
     * @return Order
     */
    public function setTitle($title): Order
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
     * @return Order
     */
    public function setDescription($description): Order
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
     * @return Order
     */
    public function setAmount($amount): Order
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
     * @return Order
     */
    public function setType($type): Order
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
     * @return Order
     */
    public function setAttributes($attributes): Order
    {
        $this->attributes = $attributes;
        return $this;
    }
}
