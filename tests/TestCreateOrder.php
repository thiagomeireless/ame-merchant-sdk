<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Data\Attribute;
use AmeMerchant\Data\Item;
use AmeMerchant\Data\Order;
use AmeMerchant\Request\AuthenticationRequest;
use AmeMerchant\Request\CreateOrderRequest;

$authRequest = new AuthenticationRequest(
    '3ace3020-83db-4f0f-bccf-ee2f8ab902e4',
    '8ab72f81-20cf-4f5e-b12e-1c44a98d6383'
);

try {
    $authData = $authRequest->execute();

    $item = new Item();
    $item->setAmount(100)
         ->setDescription('Teste de criação de item')
         ->setQuantity(1);

    $item2 = new Item();
    $item2->setAmount(250)
          ->setDescription('Criação de outro item')
          ->setQuantity(2);

    $attribute = new Attribute();
    $attribute->setCashbackAmountValue(10)
              ->setTransactionChangedCallbackUrl('https://teste.localhost/callback')
              ->setItems([$item, $item2])
              ->setCustomPayload(['teste' => 'testando - 123']);

    $order = new Order();
    $order->setTitle('Minha primeira ordem.')
          ->setDescription('Criação de ordem para testes.')
          ->setType('PAYMENT')
          ->setAmount(350)
          ->setAttributes($attribute);

    $request = new CreateOrderRequest($authData->getAccessToken(), $order);

    $teste = $request->withDebug()->execute();

    echo json_encode($teste, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    echo 'ERRO 2: ' . $e->getMessage();
}
