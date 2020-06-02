<?php

declare(strict_types = 1);

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Request\AuthenticationRequest;
use AmeMerchant\Request\CancelOrderRequest;
use AmeMerchant\Request\VerifyOrderRequest;

$authRequest = new AuthenticationRequest(
    '3ace3020-83db-4f0f-bccf-ee2f8ab902e4',
    '8ab72f81-20cf-4f5e-b12e-1c44a98d6383'
);

try {
    $authData = $authRequest->execute();

    $cancelOrderRequest = new CancelOrderRequest(
        $authData->getAccessToken(),
        '5b036378-2f2f-47bb-a4e7-557c5e02b4ee'
    );

    $response = $cancelOrderRequest->execute();

    echo json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    echo 'ERRO 3: ' . $e->getCode() . ' - ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString();
}
