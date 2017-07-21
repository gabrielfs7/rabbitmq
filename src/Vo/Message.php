<?php

namespace GSoares\RabbitMQ\Vo;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Message
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $message;

    /**
     * @var float
     */
    private $time;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return float
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param float $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
}