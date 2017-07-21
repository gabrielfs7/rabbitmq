<?php

namespace GSoares\RabbitMQ\Factory;

use GSoares\RabbitMQ\Vo\ChannelConfiguration;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ChannelFactory
{

    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    /**
     * @param ChannelConfiguration $channelConfigurationDto
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    function createChannel(ChannelConfiguration $channelConfigurationDto)
    {
        $channel = $this->connection->channel();
        $channel->queue_declare(
            $channelConfigurationDto->getQueueName(),
            $channelConfigurationDto->isQueuePassive(),
            $channelConfigurationDto->isQueueDurable(),
            $channelConfigurationDto->isQueueAutoDeletable(),
            $channelConfigurationDto->queueDoesNotWait()
        );

        $channel->basic_qos(null, $channelConfigurationDto->getSimultaneouslyMessages(), null);
        $channel->exchange_declare(
            $channelConfigurationDto->getExchangeName(),
            $channelConfigurationDto->getExchangeType(),
            false,
            false,
            false
        );

        return $channel;
    }
}