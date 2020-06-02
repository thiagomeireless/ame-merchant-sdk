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
        $vars = get_object_vars($this);

        return array_filter($vars, static function ($value) {
            return $value !== null;
        });
    }

    public static function createFromArray(array $data): Item
    {
        $instance = new self();

        foreach ($data as $property => $value) {
            if (property_exists($instance, $property)) {
                $instance->{$property} = $value;
            }
        }

        return $instance;
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
