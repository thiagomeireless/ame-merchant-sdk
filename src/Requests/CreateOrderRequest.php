<?php

namespace AmeMerchant\Requests;

use AmeMerchant\Data\Order;
use AmeMerchant\Responses\CreateOrderResponse;
use GuzzleHttp\Psr7\Request;
use Throwable;

class CreateOrderRequest extends BaseRequest
{
    /** @var string */
    private $token;

    /** @var Order */
    private $order;

    /**
     * CreateOrderRequest constructor.
     *
     * @param string $token
     * @param Order $order
     * @param bool $production
     */
    public function __construct(string $token, Order $order, bool $production = true)
    {
        parent::__construct($production);

        $this->order = $order;
        $this->token = $token;
    }

    /**
     * @return CreateOrderResponse
     */
    public function execute(): CreateOrderResponse
    {
        return parent::execute();
    }

    /**
     * @return Request
     */
    protected function makeRequest(): Request
    {
        return new Request(
            'POST',
            'orders',
            ['Authorization' => "Bearer {$this->token}"],
            json_encode($this->order)
        );
    }

    /**
     * @param array $responseBody
     * @return CreateOrderResponse
     */
    protected function readResponse(array $responseBody): CreateOrderResponse
    {
        return new CreateOrderResponse($responseBody);
    }
}
