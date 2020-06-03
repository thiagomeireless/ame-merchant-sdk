# SDK Ame Merchant API

SDK criado com objetivo de facilitar a integração com a API Merchant da AME: https://amedigital.github.io/

## Dependências
* PHP >= 7.0

## Exemplos

A pasta examples contém exemplos de cada request que pode ser realizada e podem ser executadas via php no terminal:

`php examples/1-authentication.php`

Foi criado também um ambiente Docker para facilitar a utilização dos exemplos, que pode ser utilizado da seguinte forma:

* Copiar o arquivo `.env.example` para `.env` e preencher as 3 informações necessárias.
* No diretório do projeto, executar `docker-compose up -d --build`
* Executar `docker-compose exec php-fpm bash` para entrar no container
* Acessar a pasta examples `cd examples`
* Executar o exemplo desejado, de preferência na ordem. Exemplo:  

    * Autenticar na AME e salvar o token no Redis: `php 1-authentication.php`
    * Criar nova ordem: `php 2-create-order.php`
    * etc... 


---
### Exemplos de utilização

#### Autenticação para obter token

```php
<?php

require_once('vendor/autoload.php');

use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\AuthenticationRequest;
use Cache; // Algum storage para salvar o token obtido e reutilizar nas próximas requisições

// Cria uma nova request de autenticação
$request = new AuthenticationRequest(
    'USUÁRIO_LIBERADO_PELA_AME',
    'SENHA_LIBERADA_PELA_AME',
    false // flag para informar em qual ambiente a request será realizada. Default: true (produção)
);

try {
    // Executa a request com informação de debug do Guzzle (não utilizar em Produção)
    $response = $request->withDebug()->execute();
    echo "\n\nRESPONSE:\n";
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    
    // Salva o token num Cache (ou outro storage de preferência) utilizando o tempo (em segundos) informado pela AME.
    Cache::set('ame-token', $response->getAccessToken(), $response->getExpiresIn());
} catch (AmeMerchantSdkException $e) {
    // Tratar os erros do SDK aqui
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
}
```
---
#### Criando uma nova ordem

```php
<?php

require_once('vendor/autoload.php');

use AmeMerchant\Data\Attribute;
use AmeMerchant\Data\Item;
use AmeMerchant\Data\Order;
use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\CreateOrderRequest;
use Cache; // Algum storage onde o token está salvo

// Token obtido na requisação de autenticação, que pode estar num cache ou algum outro storage.
$token = Cache::get('ame-token');

// Cria itens que foram vendidos nessa ordem
$item = new Item();
$item->setAmount(100)
     ->setDescription('Teste de criação de item')
     ->setQuantity(1);

$item2 = new Item();
$item2->setAmount(250)
      ->setDescription('Criação de outro item')
      ->setQuantity(2);

// Cria o Atributo dessa ordem
$attribute = new Attribute();
$attribute->setCashbackAmountValue(10)
          ->setTransactionChangedCallbackUrl('https://meudominio.com/callback')
          ->setItems([$item, $item2])
          ->setPaymentOnce(true)
          ->setCustomPayload(['teste' => 'testando - 123']);

// Cria a Ordem com os dados criados anteriormente
$order = new Order();
$order->setTitle('Minha primeira ordem.')
      ->setDescription('Criação de ordem para testes.')
      ->setType('PAYMENT')
      ->setAmount(600)
      ->setAttributes($attribute);

try {
    // Cria nova request de criação de ordem em ambiente de homologação.
    $createOrderRequest = new CreateOrderRequest($token, $order, false);

    // Executa a request com o debug do Guzzle ativado.
    $response = $createOrderRequest->withDebug()->execute();

    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
} catch (AmeMerchantSdkException $e) {
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
}
```
---
#### Cancelando uma ordem ainda não capturada
```php
<?php

require_once('vendor/autoload.php');

use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\CancelOrderRequest;
use Cache;

$token = Cache::get('ame-token');

try {
    $cancelOrderRequest = new CancelOrderRequest(
        $token,
        'XYZ', //ID da autorização da ordem recebido via callback
    );

    $response = $cancelOrderRequest->withDebug()->execute();

    echo json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (AmeMerchantSdkException $e) {
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
}
```
---
#### Capturando uma ordem

```php
<?php

require_once('vendor/autoload.php');

use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\CaptureOrderRequest;
use Cache;

$token = Cache::get('ame-token');

try {
    $captureOrderRequest = new CaptureOrderRequest(
        $token,
        'XYZ', //ID da autorização da ordem recebido via callback
    );

    $response = $captureOrderRequest->withDebug()->execute();

    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (AmeMerchantSdkException $e) {
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
}
```
---
### Estornando uma ordem capturada

```php
<?php

require_once('vendor/autoload.php');

use AmeMerchant\Exceptions\AmeMerchantSdkException;
use AmeMerchant\Requests\RefundOrderRequest;
use Cache;

$token = Cache::get('ame-token');

try {
    $refundOrderRequest = new RefundOrderRequest(
        $token,
        'XYZ', //ID da autorização da ordem recebido via callback
        $rand = md5(microtime()), //ID único para identificar esse estorno (geração própria)
        600 //Valor que deve ser estornado
    );

    $response = $refundOrderRequest->withDebug()->execute();

    echo json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (AmeMerchantSdkException $e) {
    echo "\n############################## ERROR #############################\n#\n";
    echo "# Status Code: {$e->getStatusCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Description: {$e->getErrorDescription()}\n";
    echo "#\n###################################################################\n";
}
```
