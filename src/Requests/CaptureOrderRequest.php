<?php

namespace AmeMerchant\Requests;

use AmeMerchant\Data\Order;
use AmeMerchant\Responses\CaptureOrderResponse;
use GuzzleHttp\Psr7\Request;
use Throwable;

class CaptureOrderRequest extends BaseRequest
{
    /** @var string */
    private $token;

    /** @var Order */
    private $authorizationId;

    /**
     * CaptureOrderRequest constructor.
     *
     * @param string $token
     * @param string $authorizationId
     * @param bool $production
     */
    public function __construct(string $token, string $authorizationId, bool $production = true)
    {
        parent::__construct($production);

        $this->authorizationId = $authorizationId;
        $this->token           = $token;
    }


    public function execute(): CaptureOrderResponse
    {
        return parent::execute();
    }

    /**
     * @return Request
     */
    protected function makeRequest(): Request
    {
        return new Request(
            'PUT',
            "wallet/user/payments/{$this->authorizationId}/capture",
            ['Authorization' => "Bearer {$this->token}"]
        );
    }

    /**
     * @param array $responseBody
     * @return CaptureOrderResponse
     */
    protected function readResponse(array $responseBody): CaptureOrderResponse
    {
        return new CaptureOrderResponse($responseBody);
    }
}
