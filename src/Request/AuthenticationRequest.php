<?php

namespace AmeMerchant\Request;

use AmeMerchant\Response\LoginResponse;
use GuzzleHttp\Psr7\Request;

class AuthenticationRequest extends BaseRequest
{
    /** @var string */
    private $credentials;

    public function __construct(string $user, string $password)
    {
        parent::__construct();

        $this->credentials = base64_encode("{$user}:{$password}");
    }

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
     * @param array $responseBody
     * @return LoginResponse
     */
    protected function readResponse(array $responseBody): LoginResponse
    {
        return new LoginResponse($responseBody);
    }

    public function execute(): LoginResponse
    {
        return parent::execute();
    }
}
