<?php
$configFile = __DIR__ . '/config.json';

if (file_exists($configFile) && is_readable($configFile)) {
    return json_decode(file_get_contents($configFile));
}

throw new \LogicException("Missing configuration file [config.json]");