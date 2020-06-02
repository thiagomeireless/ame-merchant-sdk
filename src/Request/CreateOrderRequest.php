<?php

namespace AmeMerchant\Request;

use AmeMerchant\Data\Order;
use AmeMerchant\Response\CreateOrderResponse;
use AmeMerchant\Response\LoginResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use RuntimeException;
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
     */
    public function __construct(string $token, Order $order)
    {
        parent::__construct();

        $this->order = $order;
        $this->token = $token;
    }


    public function execute(): CreateOrderResponse
    {
        return parent::execute();
    }

    /**
     * @return Request
     */
    protected function makeRequest(): Request
    {
        try {
            return new Request(
                'POST',
                'orders',
                ['Authorization' => "Bearer {$this->token}"],
                json_encode($this->order, JSON_THROW_ON_ERROR)
            );
        } catch (Throwable $e) {
            die('morreu: '. $e->getMessage());
        }
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