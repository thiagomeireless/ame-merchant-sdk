<?php

namespace AmeMerchant\Requests;

use AmeMerchant\Responses\RefundOrderResponse;
use GuzzleHttp\Psr7\Request;
use JsonException;
use Throwable;

/**
 * Class RefundOrderRequest
 * @package AmeMerchant\Requests
 */
class RefundOrderRequest extends BaseRequest
{
    /** @var string */
    private $token;

    /** @var string */
    private $orderId;

    /** @var string */
    private $refundId;

    /** @var int */
    private $amount;

    /**
     * RefundOrderRequest constructor.
     *
     * @param string $token
     * @param string $orderId
     * @param string $refundId
     */
    public function __construct(string $token, string $orderId, string $refundId, int $amount)
    {
        parent::__construct();

        $this->token    = $token;
        $this->orderId  = $orderId;
        $this->refundId = $refundId;
        $this->amount   = $amount;
    }

    /**
     * @return RefundOrderResponse
     */
    public function execute(): RefundOrderResponse
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
                "payments/{$this->orderId}/refunds/{$this->refundId}",
                ['Authorization' => "Bearer {$this->token}"],
                json_encode(['amount' => $this->amount])
            );
        } catch (Throwable $e) {
            die('morreu: '. $e->getMessage());
        }
    }

    /**
     * @param array $responseBody
     * @return RefundOrderResponse
     */
    protected function readResponse(array $responseBody): RefundOrderResponse
    {
        return new RefundOrderResponse($responseBody);
    }
}
