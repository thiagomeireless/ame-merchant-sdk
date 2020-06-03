<?php

declare(strict_types = 1);

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\CancelOrderRequest;

$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis', 6379);

try {
    $token = $redis->get('ame-token');

    // ID obtido via callback enviado pela AME após o cliente efetuar autorização do pagamento
    $authorizationId = $redis->get('authorizationId');

    $cancelOrderRequest = new CancelOrderRequest(
        $token,
        $authorizationId,
        false
    );

    $response = $cancelOrderRequest->withDebug()->execute();
    echo json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (AmeMerchantSdkException $e) {
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
} catch (Throwable $e) {
    echo "#################### FATAL ERROR ####################";
    echo $e->getMessage();
}
