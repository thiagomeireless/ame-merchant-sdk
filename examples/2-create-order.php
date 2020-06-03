<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use AmeMerchant\Data\Attribute;
use AmeMerchant\Data\Item;
use AmeMerchant\Data\Order;
use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\CreateOrderRequest;

$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis', 6379);

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
    //Definir uma URL de callback válida, caso contrário as autorizações não serão processadas
          ->setTransactionChangedCallbackUrl(getenv('AME_CALLBACK_URL'))
          ->setItems([$item, $item2])
          ->setCustomPayload(['teste' => 'testando - 123']);

$order = new Order();
$order->setTitle('Minha primeira ordem.')
      ->setDescription('Criação de ordem para testes.')
      ->setType('PAYMENT')
      ->setAmount(600)
      ->setAttributes($attribute);

try {
    $token = $redis->get('ame-token');

    $createOrderRequest = new CreateOrderRequest($token, $order, false);

    $response = $createOrderRequest->withDebug()->execute();
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;

    // Salva o ID da ordem no cache para utilizar nos próximos exemplo.
    $redis->set('orderId', $response->getId(), 3600);
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
