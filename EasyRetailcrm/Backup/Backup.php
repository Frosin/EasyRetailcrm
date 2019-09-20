<?php
namespace EasyRetailcrm\Backup;

class Backup
{
    private $dir;

    public function __construct()
    {
        $this->dir = realpath(__DIR__ . "/../..") . "/backup/";
        if (!file_exists($this->dir)) {
            mkdir($this->dir);
        }
    }

    public function make(string $name, $data)
    {
        file_put_contents($this->dir . "$name-" . date("Y-m-d H:i:s") . ".log", serialize($data));
    }

    public function load(string $name)
    {
        //
    }
}
