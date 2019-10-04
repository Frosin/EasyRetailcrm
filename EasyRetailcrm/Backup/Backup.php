<?php
namespace EasyRetailcrm\Backup;

use Easyretailcrm\Exception\BadDataForUnserializeException;

class Backup
{
    private $dir;

    public function __construct()
    {
        $this->dir = realpath(__DIR__ . "/../../../../..") . "/backup/";
        if (!file_exists($this->dir)) {
            mkdir($this->dir);
        }
    }

    public function make(string $name, $data)
    {
        file_put_contents($this->dir . "$name-" . date("Y-m-d H:i:s") . ".log", serialize($data));
    }

    public function loadLast(string $name)
    {
        $files = glob($this->dir . "$name*");
        $file = end($files);
        $data = unserialize(file_get_contents($file));
        if (false === $data) {
            throw new BadDataForUnserializeException("Bad data for unseralize: " . $file);
        }
        return $data;
    }
}
