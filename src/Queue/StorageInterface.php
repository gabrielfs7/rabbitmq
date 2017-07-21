<?php

namespace GSoares\RabbitMQ\Queue;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface StorageInterface
{
    /**
     * @return $this
     */
    public function clear();

    /**
     * @param string $messageId
     * @return $this
     */
    public function store($messageId);

    /**
     * @param string $messageId
     * @return $this
     */
    public function remove($messageId);

    /**
     * @param string $messageId
     * @return boolean
     */
    public function has($messageId);
}