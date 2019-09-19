<?php
namespace EasyRetailcrm\LoggerCustomizer;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use EasyRetailcrm\Exception\InvalidLoggerMethodNameException;

class LoggerCustomizer
{
    public $logger;

    public function __construct(string $prefix = '', string $logDir = 'log')
    {
        $fileName = basename($_SERVER['PHP_SELF'], ".php");
        $this->logger = new Logger($fileName."_journal");
        $path = realpath(__DIR__ . "/../../");
        $stream = new RotatingFileHandler("$path/$logDir/$fileName/log-$prefix.log", 30);
        $stream->setFilenameFormat('{filename}-{date}', 'Y-m-d');
        $this->logger->pushHandler($stream);
    }

    public function __call($name, $args)
    {
        if (!method_exists($this->logger, $name)) {
            throw new InvalidLoggerMethodNameException('Method `$name` not found in Monolog\Logger!');
        }
        $this->logger->$name($args[0], $args[1]);
    }
}
