<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/MessageDto.php';
require_once __DIR__ . '/Storage.php';

use PhpAmqpLib\Message\AMQPMessage;

$storage = new Storage();

/** @var PhpAmqpLib\Connection\AMQPStreamConnection $connection */
$connection = require_once __DIR__ . '/connection.php';

$isDurable = true;
$queueName = 'task_queue';
$exchangeName = 'logs';

$channel = $connection->channel();
$channel->queue_declare($queueName, false, $isDurable, false, false);

$id = $_SERVER['argv'][1];
$seconds = $_SERVER['argv'][2];

if ($storage->has($id)) {
    echo " [x] Message ID [$id] already exists \n";

    return;
}

$messageDto = new MessageDto();
$messageDto->time = microtime(true);
$messageDto->id = $id;
$messageDto->message = $seconds;

$channel->exchange_declare($exchangeName, 'fanout', false, false, false);
$channel->basic_publish(
    new AMQPMessage(
        $messageJson = json_encode($messageDto),
        [
            'message_id' => $messageDto->id,
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            'correlation_id' => $messageDto->id
        ]
    ),
    '',
    $queueName
);

echo " [x] Sent $messageJson \n";