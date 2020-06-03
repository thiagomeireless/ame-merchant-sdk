<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$data = file_get_contents('php://input');
$dataArr = json_decode($data, true);

$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis', 6379);
$redis->set('authorizationId', $dataArr['id'], 3600);
