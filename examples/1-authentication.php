<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\AuthenticationRequest;

$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis', 6379);

$request = new AuthenticationRequest(
    getenv('AME_MERCHANT_USER'),
    getenv('AME_MERCHANT_PASSWORD'),
    false
);

try {
    $response = $request->withDebug()->execute();
    echo json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;

    $redis->set('ame-token', $response->getAccessToken(), $response->getExpiresIn());
} catch (AmeMerchantSdkException $e) {
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
} catch (Throwable $e) {
    echo "\n########################### FATAL ERROR ##########################\n#\n";
    echo "# {$e->getMessage()}\n";
    echo "#\n###################################################################\n";
}
