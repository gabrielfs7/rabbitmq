<?php

namespace GSoares\RabbitMQ\Factory;

use GSoares\RabbitMQ\Vo\ConnectionConfiguration;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ConnectionFactory
{

    /**
     * @var array
     */
    private $configuration;

    /**
     * @var ConnectionConfiguration
     */
    private $connectionConfiguration;

    public function setConfiguration(array $configuration)
    {
        $this->configuration = (object) $configuration;
    }

    /**
     * @param ConnectionConfiguration $connectionConfiguration
     */
    public function setConnectionConfiguration(ConnectionConfiguration $connectionConfiguration)
    {
        $this->connectionConfiguration = $connectionConfiguration;
    }

    /**
     * @return AMQPStreamConnection
     */
    public function createConnection()
    {
        static $cache;

        if ($cache) {
            return $cache;
        }

        $configuration = $this->getConfiguration();

        return $cache = new AMQPStreamConnection(
            $configuration->host,
            $configuration->port,
            $configuration->user,
            $configuration->pass
        );
    }

    /**
     * @return mixed
     */
    private function getConfiguration()
    {
        return $this->connectionConfiguration ?: $this->configuration;
    }
}