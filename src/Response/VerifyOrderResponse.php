<?php

namespace AmeMerchant\Response;

use AmeMerchant\Data\Attribute;

/**
 * Class VerifyOrderResponse
 * @package AmeMerchant\Response
 */
class VerifyOrderResponse extends CreateOrderResponse
{
    /** @var string */
    protected $ownerId;

    /** @var string */
    protected $creditWalletId;

    /** @var string */
    protected $ttl;

    /** @var string */
    protected $date;

    /** @var string */
    protected $currency;

    /** @var array */
    protected $planTypes;

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
}
