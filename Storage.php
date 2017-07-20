<?php
class Storage
{

    private $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/storage.data';
    }

    public function start()
    {
        if (file_exists($this->filePath)) {
            touch($this->filePath);
        }

        file_put_contents($this->filePath, '');
    }

    /**
     * @param $id
     */
    public function add($id)
    {
        file_put_contents($this->filePath, $this->getFileContent() . "|$id^");
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        file_put_contents($this->filePath, str_replace("|$id^", "", $this->getFileContent()));
    }

    public function has($id)
    {
        return strpos($this->getFileContent(), "|$id^") !== false;
    }

    /**
     * @return int[]
     */
    public function all()
    {
        return $this->getFileContent();
    }

    private function getFileContent()
    {
        return file_get_contents($this->filePath);
    }
}