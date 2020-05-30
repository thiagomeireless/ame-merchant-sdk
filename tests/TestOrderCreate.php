<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Data\Attribute;
use AmeMerchant\Data\Item;
use AmeMerchant\Data\Order;

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
          ->setItems([$item, $item2]);

$order = new Order();
$order->setTitle('Minha primeira ordem.')
      ->setDescription('Criação de ordem para testes.')
      ->setType('PAYMENT')
      ->setAmount(350)
      ->setAttributes($attribute);

try {
    echo json_encode($order, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (JsonException $e) {
    echo 'ERRO: ' . $e->getMessage();
}
