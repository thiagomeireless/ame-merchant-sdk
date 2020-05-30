<?php

namespace AmeMerchant\Data;

use JsonSerializable;

class Attribute implements JsonSerializable
{
    /** @var int */
    private $cashbackAmountValue;

    /** @var string */
    private $transactionChangedCallbackUrl;

    /** @var Item[] */
    private $items;

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getCashbackAmountValue(): int
    {
        return $this->cashbackAmountValue;
    }

    /**
     * @param int $cashbackAmountValue
     * @return Attribute
     */
    public function setCashbackAmountValue(int $cashbackAmountValue): Attribute
    {
        $this->cashbackAmountValue = $cashbackAmountValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionChangedCallbackUrl(): string
    {
        return $this->transactionChangedCallbackUrl;
    }

    /**
     * @param string $transactionChangedCallbackUrl
     * @return Attribute
     */
    public function setTransactionChangedCallbackUrl(string $transactionChangedCallbackUrl): Attribute
    {
        $this->transactionChangedCallbackUrl = $transactionChangedCallbackUrl;
        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Item[] $items
     * @return Attribute
     */
    public function setItems(array $items): Attribute
    {
        $this->items = $items;
        return $this;
    }
}
