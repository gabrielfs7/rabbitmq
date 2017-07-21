<?php

namespace GSoares\RabbitMQ\Channel;

use GSoares\RabbitMQ\Vo\ChannelConfiguration;
use GSoares\RabbitMQ\Vo\Message;
use PhpAmqpLib\Channel\AMQPChannel;
use GSoares\RabbitMQ\Factory\StorageInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Publisher implements PublisherInterface
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var ChannelConfiguration
     */
    private $channelConfiguration;

    /**
     * @param ChannelConfiguration $channelConfiguration
     * @return $this
     */
    public function setChannelConfiguration(ChannelConfiguration $channelConfiguration)
    {
        $this->channelConfiguration = $channelConfiguration;

        return $this;
    }

    /**
     * @param StorageInterface $storage
     * @return $this
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * @param AMQPChannel $channel
     * @param Message $message
     */
    public function publish(AMQPChannel $channel, Message $message)
    {
        if ($this->storage->has($message->getId())) {
            return;
        }

        $channel->basic_publish(
            new AMQPMessage(
                serialize($message),
                [
                    'message_id' => $message->getId(),
                    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                    'correlation_id' => $message->getId()
                ]
            ),
            '',
            $this->channelConfiguration->getQueueName()
        );
    }
}