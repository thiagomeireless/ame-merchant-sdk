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
     * CancelOrderRequest constructor.
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
