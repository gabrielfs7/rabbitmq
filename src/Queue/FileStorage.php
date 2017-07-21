<?php

namespace GSoares\RabbitMQ\Queue;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class FileStorage implements StorageInterface
{

    /**
     * @var string
     */
    private $filePath;

    public function __construct($rootPath)
    {
        $this->filePath = "$rootPath/storage.data";
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->startStorageFile();

        return $this;
    }

    /**
     * @param $messageId
     * @return $this
     */
    public function remove($messageId)
    {
        file_put_contents($this->filePath, str_replace("|$messageId^", "", $this->getFileContent()));

        return $this;
    }

    /**
     * @param string $messageId
     * @return bool
     */
    public function has($messageId)
    {
        return strpos($this->getFileContent(), "|$messageId^") !== false;
    }

    /**
     * @param string $messageId
     * @return $this
     */
    public function store($messageId)
    {
        file_put_contents($this->filePath, $this->getFileContent() . "|$messageId^");

        return $this;
    }

    /**
     * @return string
     */
    private function getFileContent()
    {
        return file_get_contents($this->filePath);
    }

    private function startStorageFile()
    {
        if (file_exists($this->filePath)) {
            touch($this->filePath);
        }

        file_put_contents($this->filePath, '');
    }
}