<?php

namespace AmeMerchant\Request;

use AmeMerchant\Data\Order;
use AmeMerchant\Response\CancelOrderResponse;
use AmeMerchant\Response\CreateOrderResponse;
use AmeMerchant\Response\LoginResponse;
use AmeMerchant\Response\VerifyOrderResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use RuntimeException;
use Throwable;

class CancelOrderRequest extends BaseRequest
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


    public function execute(): CancelOrderResponse
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
                'PUT',
                "wallet/user/payments/{$this->orderId}/cancel",
                ['Authorization' => "Bearer {$this->token}"]
            );
        } catch (Throwable $e) {
            die('morreu: '. $e->getMessage());
        }
    }

    /**
     * @param array $responseBody
     * @return CancelOrderResponse
     */
    protected function readResponse(array $responseBody): CancelOrderResponse
    {
        return new CancelOrderResponse($responseBody);
    }
}
