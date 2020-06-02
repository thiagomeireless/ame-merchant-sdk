<?php

namespace AmeMerchant\Requests;

use AmeMerchant\Responses\AuthenticationResponse;
use GuzzleHttp\Psr7\Request;

/**
 * Class AuthenticationRequest
 * @package AmeMerchant\Requests
 */
class AuthenticationRequest extends BaseRequest
{
    /** @var string */
    private $credentials;

    /**
     * AuthenticationRequest constructor.
     *
     * @param string $user
     * @param string $password
     * @param bool $production
     */
    public function __construct(string $user, string $password, bool $production = true)
    {
        parent::__construct($production);

        $this->credentials = base64_encode("{$user}:{$password}");
    }

    /**
     * @return Request
     */
    protected function makeRequest(): Request
    {
        return new Request(
            'POST',
            'auth/oauth/token',
            [
                'Content-Type'  => 'application/x-www-form-urlencoded',
                'Authorization' => "Basic {$this->credentials}"
            ],
            http_build_query([
                'grant_type' => 'client_credentials',
            ])
        );
    }

    /**
     * @return AuthenticationResponse
     */
    public function execute(): AuthenticationResponse
    {
        return parent::execute();
    }

    /**
     * @param array $responseBody
     * @return AuthenticationResponse
     */
    protected function readResponse(array $responseBody): AuthenticationResponse
    {
        return new AuthenticationResponse($responseBody);
    }
}
