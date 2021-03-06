<?php

namespace AmeMerchant\Data;

use JsonSerializable;

class Attribute implements JsonSerializable
{
    /** @var string */
    private $orderId;

    /** @var bool */
    private $paymentOnce;

    /** @var int */
    private $cashbackAmountValue;

    /** @var array */
    private $customPayload;

    /** @var Item[] */
    private $items;

    /** @var string */
    private $transactionChangedCallbackUrl;

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
     * @param array $attributes
     * @return Attribute
     */
    public static function createFromArray(array $attributes): Attribute
    {
        $instance = new self();

        foreach ($attributes as $property => $value) {
            if (property_exists($instance, $property)) {
                if ($property === 'items') {
                    $items = [];

                    foreach($attributes['items'] as $item) {
                        $items[] = Item::createFromArray($item);
                    }

                    $instance->items = $items;
                } else {
                    $instance->{$property} = $value;
                }
            }
        }

        return $instance;
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

    /**
     * @return array
     */
    public function getCustomPayload(): array
    {
        return $this->customPayload;
    }

    /**
     * @param array $customPayload
     * @return Attribute
     */
    public function setCustomPayload(array $customPayload): Attribute
    {
        $this->customPayload = $customPayload;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPaymentOnce(): bool
    {
        return $this->paymentOnce;
    }

    /**
     * @param bool $paymentOnce
     * @return Attribute
     */
    public function setPaymentOnce(bool $paymentOnce): Attribute
    {
        $this->paymentOnce = $paymentOnce;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
