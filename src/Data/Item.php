<?php

namespace AmeMerchant\Data;

use JsonSerializable;

class Item implements JsonSerializable
{
    /** @var string */
    private $description;

    /** @var int */
    private $quantity;

    /** @var int */
    private $amount;

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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return Item
     */
    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
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
     * @return Item
     */
    public function setAmount(int $amount): Item
    {
        $this->amount = $amount;
        return $this;
    }
}
