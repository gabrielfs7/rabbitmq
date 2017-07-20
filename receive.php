<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Storage.php';

/** @var PhpAmqpLib\Connection\AMQPStreamConnection $connection */
$connection = require_once __DIR__ . '/connection.php';

$storage = new Storage();
$storage->start();

$isDurable = true;
$maxMessagesPerWork = 10;
$queueName = 'task_queue';

$channel = $connection->channel();
$channel->queue_declare($queueName, false, $isDurable, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

# Tells how many messages a worker can deal at a time
$channel->basic_qos(null, $maxMessagesPerWork, null);
$channel->basic_consume(
    $queueName,
    '',
    false,
    false,
    false,
    false,
    function($message) use ($storage) {
        /** @var \PhpAmqpLib\Message\AMQPMessage $message */
        $message = $message;
        $messageId = $message->get('message_id');

        $storage->add($messageId);

        /** @var MessageDto $messageDto */
        $messageDto = json_decode($message->body);

        $timeSpent = microtime(true) - $messageDto->time;
        echo " [x] Received [sleep for {$messageDto->message}'s]($timeSpent's) {$message->body} \n";
        sleep($messageDto->message);
        echo " [x] Done [sleep for {$messageDto->message}'s]($timeSpent's) {$message->body} \n";

        /** @var \PhpAmqpLib\Message\AMQPMessage $message */
        $message->delivery_info['channel']
            ->basic_ack($message->delivery_info['delivery_tag'], true);

        $storage->remove($messageId);
    }
);

while(count($channel->callbacks)) {
    $channel->wait();
}