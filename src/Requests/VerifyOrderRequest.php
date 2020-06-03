<?php

namespace AmeMerchant\Requests;

use AmeMerchant\Responses\VerifyOrderResponse;
use GuzzleHttp\Psr7\Request;
use Throwable;

/**
 * Class VerifyOrderRequest
 * @package AmeMerchant\Requests
 */
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
     * @param bool $production
     */
    public function __construct(string $token, string $orderId, bool $production = true)
    {
        parent::__construct($production);

        $this->token   = $token;
        $this->orderId = $orderId;
    }

    /**
     * @return VerifyOrderResponse
     */
    public function execute(): VerifyOrderResponse
    {
        return parent::execute();
    }

    /**
     * @return Request
     */
    protected function makeRequest(): Request
    {
        return new Request(
            'GET',
            "orders/{$this->orderId}",
            ['Authorization' => "Bearer {$this->token}"]
        );
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
