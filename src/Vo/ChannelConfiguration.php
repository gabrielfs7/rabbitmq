<?php

namespace GSoares\RabbitMQ\Vo;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ChannelConfiguration
{

    /**
     * @var boolean
     */
    private $isQueueDurable = true;

    /**
     * @var boolean
     */
    private $isQueuePassive = false;

    /**
     * @var string
     */
    private $queueName = 'task_queue';

    /**
     * @var string
     */
    private $exchangeName = 'logs';

    /**
     * @var string
     */
    private $exchangeType = 'fanout';

    /**
     * @var boolean
     */
    private $isQueueAutoDeletable = false;

    /**
     * @var boolean
     */
    private $queueDoesNotWait = false;

    /**
     * @var int
     */
    private $simultaneouslyMessages = 1;

    /**
     * @return boolean
     */
    public function isQueueDurable()
    {
        return $this->isQueueDurable;
    }

    /**
     * @param boolean $isQueueDurable
     */
    public function setQueueDurable($isQueueDurable)
    {
        $this->isQueueDurable = $isQueueDurable;
    }

    /**
     * @return boolean
     */
    public function isQueuePassive()
    {
        return $this->isQueuePassive;
    }

    /**
     * @param boolean $isQueuePassive
     */
    public function setQueuePassive($isQueuePassive)
    {
        $this->isQueuePassive = $isQueuePassive;
    }

    /**
     * @return string
     */
    public function getExchangeType()
    {
        return $this->exchangeType;
    }

    /**
     * @param string $exchangeType
     * @return $this
     */
    public function setExchangeType($exchangeType)
    {
        $this->exchangeType = $exchangeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getExchangeName()
    {
        return $this->exchangeName;
    }

    /**
     * @param string $exchangeName
     * @return $this
     */
    public function setExchangeName($exchangeName)
    {
        $this->exchangeName = $exchangeName;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
    }

    /**
     * @return boolean
     */
    public function isQueueAutoDeletable()
    {
        return $this->isQueueAutoDeletable;
    }

    /**
     * @param string $isQueueAutoDeletable
     */
    public function setQueueAutoDeletable($isQueueAutoDeletable)
    {
        $this->isQueueAutoDeletable = $isQueueAutoDeletable;
    }

    /**
     * @return boolean
     */
    public function queueDoesNotWait()
    {
        return $this->queueDoesNotWait;
    }

    /**
     * @param string $queueDoesNotWait
     */
    public function setQueueDoesNotWait($queueDoesNotWait)
    {
        $this->queueDoesNotWait = $queueDoesNotWait;
    }

    /**
     * @return int
     */
    public function getSimultaneouslyMessages()
    {
        return $this->simultaneouslyMessages;
    }

    /**
     * @param int $simultaneouslyMessages
     */
    public function setSimultaneouslyMessages($simultaneouslyMessages)
    {
        $this->simultaneouslyMessages = $simultaneouslyMessages;
    }
}