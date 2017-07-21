<?php

namespace GSoares\RabbitMQ\Channel;

use GSoares\RabbitMQ\Queue\StorageInterface;
use GSoares\RabbitMQ\Vo\ChannelConfiguration;
use GSoares\RabbitMQ\Vo\Message;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface ConsumerInterface
{
    /**
     * @param ChannelConfiguration $channelConfiguration
     * @return $this
     */
    public function setChannelConfiguration(ChannelConfiguration $channelConfiguration);

    /**
     * @param StorageInterface $storage
     * @return $this
     */
    public function setStorage(StorageInterface $storage);

    /**
     * @param AMQPChannel $channel
     */
    public function consume(AMQPChannel $channel);

    /**
     * @param Message $messageVo
     */
    public function handleMessage(Message $messageVo);
}