<?php

namespace AmeMerchant\Request;

use AmeMerchant\Data\Order;
use AmeMerchant\Response\CreateOrderResponse;
use AmeMerchant\Response\LoginResponse;
use AmeMerchant\Response\VerifyOrderResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use RuntimeException;
use Throwable;

class VerifyOrderRequest extends BaseRequest
{
    /** @var string */
    private $token;

    /** @var string */
    private $orderId;

    /**
     * VerifyOrderRequest constructor.
     *
     * @param string $token
     * @param string $orderId
     */
    public function __construct(string $token, string $orderId)
    {
        parent::__construct();

        $this->token   = $token;
        $this->orderId = $orderId;
    }


    public function execute(): VerifyOrderResponse
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
                'GET',
                "orders/{$this->orderId}",
                ['Authorization' => "Bearer {$this->token}"]
            );
        } catch (Throwable $e) {
            die('morreu: '. $e->getMessage());
        }
    }

    /**
     * @param array $responseBody
     * @return VerifyOrderResponse
     */
    protected function readResponse(array $responseBody): VerifyOrderResponse
    {
        return new VerifyOrderResponse($responseBody);
    }
}
