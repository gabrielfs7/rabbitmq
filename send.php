<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/MessageDto.php';

use PhpAmqpLib\Message\AMQPMessage;

/** @var PhpAmqpLib\Connection\AMQPStreamConnection $connection */
$connection = require_once __DIR__ . '/connection.php';

$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);

$messageDto = new MessageDto();
$messageDto->time = microtime(true);
$messageDto->id = uniqid();
$messageDto->message = strtoupper(range('a', 'z')[rand(0, 23)]);

$channel->basic_publish(new AMQPMessage($messageJson = json_encode($messageDto)), '', 'hello');

echo " [x] Sent $messageJson \n";