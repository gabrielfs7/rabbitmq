<?php
$config = require_once __DIR__ . '/configuration.php';
return new \PhpAmqpLib\Connection\AMQPStreamConnection($config->host, $config->port, $config->user, $config->pass);