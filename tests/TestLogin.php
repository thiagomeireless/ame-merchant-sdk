<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Request\AuthenticationRequest;

$request = new AuthenticationRequest(
    '3ace3020-83db-4f0f-bccf-ee2f8ab902e4',
    '8ab72f81-20cf-4f5e-b12e-1c44a98d6383'
);

$teste = $request->execute();

try {
    echo json_encode($teste, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (JsonException $e) {
    echo 'ERRO: ' . $e->getMessage();
}
