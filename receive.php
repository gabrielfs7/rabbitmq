<?php
require_once __DIR__ . '/vendor/autoload.php';

/** @var PhpAmqpLib\Connection\AMQPStreamConnection $connection */
$connection = require_once __DIR__ . '/connection.php';

$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$channel->basic_consume(
    'hello',
    '',
    false,
    true,
    false,
    false,
    function($message) {
        sleep(rand(1, 3));
        /** @var MessageDto $messageDto */
        $messageDto = json_decode($message->body);
        $timeSpent = microtime(true) - $messageDto->time;

        echo " [x] Received ($timeSpent's) {$message->body} \n";
    }
);

while(count($channel->callbacks)) {
    $channel->wait();
}