<?php

namespace AmeMerchant\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use RuntimeException;
use Throwable;

abstract class BaseRequest
{
    /** @var Client $client */
    protected $client;

    protected $debug = false;

    private $baseUri = [
        'hml'  => 'https://api.hml.amedigital.com/api/',
        'prod' => 'https://api.prod.amedigital.com/api/'
    ];

    /**
     * BaseRequest constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUri['hml'],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip, deflate',
            ],
        ]);
    }

    /**
     * Activates Guzzle debug for this object context
     *
     * @return $this
     */
    public function withDebug(): self
    {
        $this->debug = true;
        return $this;
    }

    public function execute()
    {
        try {
            $response = $this->client->send(
                $this->makeRequest(),
                ['debug' => $this->debug]
            );

            return $this->readResponse(
                json_decode((string) $response->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR)
            );
        } catch (GuzzleException $e) {
            $code    = -1;
            $message = 'Request Error';
            $errors  = [];

            if ($response = $e->getResponse()) {
                $code = $response->getStatusCode();

                $body = json_decode((string) $response->getBody(), false, 512, JSON_THROW_ON_ERROR);

                $message = $body->message ?? $message;

                $errors = $body->errors ?? $errors;
            }

            throw new RuntimeException($message, $code, $e);
        } catch (Throwable $e) {
            die('okok');
        }
    }

    /**
     * @return Request
     */
    abstract protected function makeRequest(): Request;

    /**
     * Read the response and return it serialized
     *
     * @param array $responseBody
     */
    abstract protected function readResponse(array $responseBody);
}
