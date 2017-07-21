<?php

namespace GSoares\RabbitMQ\Channel;

use GSoares\RabbitMQ\Queue\StorageInterface;
use GSoares\RabbitMQ\Vo\ChannelConfiguration;
use GSoares\RabbitMQ\Vo\Message;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Consumer implements ConsumerInterface
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
     */
    public function consume(AMQPChannel $channel)
    {
        $channel->basic_consume(
            $this->channelConfiguration->getQueueName(),
            '',
            false,
            false,
            false,
            false,
            function($message) {
                /** @var \PhpAmqpLib\Message\AMQPMessage $message */
                $message = $message;
                $messageId = $message->get('message_id');

                $this->storage->remove($messageId);

                /** @var Message $messageVo */
                $messageVo = unserialize($message->body);

                $this->handleMessage($messageVo);

                /** @var \PhpAmqpLib\Message\AMQPMessage $message */
                $message->delivery_info['channel']
                    ->basic_ack($message->delivery_info['delivery_tag'], true);
            }
        );

        while(count($channel->callbacks)) {
            $channel->wait();
        }
    }

    /**
     * @param Message $messageVo
     */
    public function handleMessage(Message $messageVo)
    {
        $timeSpent = microtime(true) - $messageVo->getTime();

        sleep($messageVo->getMessage());

        echo " [x] Received message [{$messageVo->getId()}] [sleep for {$messageVo->getMessage()}'s]($timeSpent's)\n";
    }
}