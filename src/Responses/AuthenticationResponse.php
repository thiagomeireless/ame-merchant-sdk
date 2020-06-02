<?php

namespace AmeMerchant\Responses;

use JsonSerializable;

/**
 * Class LoginResponse
 * @package AmeMerchant\Responses
 */
class AuthenticationResponse implements JsonSerializable
{
    /** @var array */
    private $payload;

    /** @var array */
    private $scope;

    /** @var string */
    private $access_token;

    /** @var string */
    private $token_type;

    /** @var integer */
    private $expires_in;

    /** @var string */
    private $jti;

    /**
     * LoginResponse constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        foreach ($values as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);

        return array_filter($vars, static function ($value) {
            return $value !== null;
        });
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function getScope(): array
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @return string
     */
    public function getJti(): string
    {
        return $this->jti;
    }
}
