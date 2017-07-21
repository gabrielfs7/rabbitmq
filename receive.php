<?php
/** @var \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder */
$containerBuilder = require_once __DIR__ . '/bootstrap.php';

$containerBuilder->get('service.queue.file_storage')
    ->clear();

$channelConfiguration = new \GSoares\RabbitMQ\Vo\ChannelConfiguration();

$connection = $containerBuilder->get('service.factory.connection')
    ->createConnection();

$channel = $containerBuilder
    ->get('service.factory.channel')
    ->setConnection($connection)
    ->createChannel($channelConfiguration);

$containerBuilder
    ->get('service.channel.consumer')
    ->setChannelConfiguration($channelConfiguration)
    ->consume($channel);