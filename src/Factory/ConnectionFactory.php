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
     * @var $configurationPath
     */
    private $configurationPath;

    /**
     * @var ConnectionConfiguration
     */
    private $connectionConfiguration;

    /**
     * @param string $configurationPath
     */
    public function __construct($configurationPath)
    {
        if (file_exists($configurationPath) && is_readable($configurationPath)) {
            $this->configurationPath = file_get_contents($configurationPath);
        }

        throw new \LogicException("Missing configuration file [config.json]");
    }

    /**
     * @param ConnectionConfiguration $connectionConfiguration
     */
    public function setConfigurationDto(ConnectionConfiguration $connectionConfiguration)
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
        return $this->connectionConfiguration ?: json_decode(file_get_contents($this->configurationPath));
    }
}