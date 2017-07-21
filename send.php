<?php
/** @var \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder */
$containerBuilder = require_once __DIR__ . '/bootstrap.php';
$channelConfiguration = new \GSoares\RabbitMQ\Vo\ChannelConfiguration();

$connection = $containerBuilder->get('service.factory.connection')
    ->createConnection();

$channel = $containerBuilder
    ->get('service.factory.channel')
    ->setConnection($connection)
    ->createChannel($channelConfiguration);

$message = new \GSoares\RabbitMQ\Vo\Message();
$message->setTime(microtime(true));
$message->setId($_SERVER['argv'][1]);
$message->setMessage($_SERVER['argv'][2]);

$containerBuilder
    ->get('service.channel.publisher')
    ->setChannelConfiguration($channelConfiguration)
    ->publish($channel, $message);