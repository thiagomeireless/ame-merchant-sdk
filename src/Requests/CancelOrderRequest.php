<?php

namespace AmeMerchant\Requests;

use AmeMerchant\Responses\CancelOrderResponse;
use GuzzleHttp\Psr7\Request;
use Throwable;

/**
 * Class CancelOrderRequest
 * @package AmeMerchant\Requests
 */
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

    /**
     * @return CancelOrderResponse
     */
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
