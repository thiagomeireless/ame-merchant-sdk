<?php

namespace AmeMerchant\Response;

use AmeMerchant\Data\Attribute;
use AmeMerchant\Data\Order;

/**
 * Class CreateOrderResponse
 * @package AmeMerchant\Response
 */
class CreateOrderResponse extends Order
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $qrCodeLink;

    /** @var string */
    protected $deepLink;

    /**
     * LoginResponse constructor.
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
