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
     * @param AMQPStreamConnection $connection
     * @return $this
     */
    public function setConnection(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;

        return $this;
    }

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
        $channel->queue_bind(
            $channelConfigurationDto->getQueueName(), 
            $channelConfigurationDto->getExchangeName(), 
            $channelConfigurationDto->getQueueName()
        );

        return $channel;
    }
}
