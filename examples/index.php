<?php

// Arquivo utilizado apenas para simular o recebimento de callbacks
// Nos meus testes utilizo o aplicativo `ngrok` para abrir uma porta externa e a AME conseguir enviar os callbacks
// Exemplo: Antes de iniciar o ambiente docker, executar o comando `ngrok http 3210` e setar a URL criada pelo ngrok
// na variável AME_CALLBACK_URL no arquivo .env

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$data = file_get_contents('php://input');
$dataArr = json_decode($data, true);

$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis', 6379);
$redis->set('authorizationId', $dataArr['id'], 3600);
