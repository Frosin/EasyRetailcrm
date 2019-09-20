<?php
namespace EasyRetailcrm\LoggerCustomizer;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\WildfireFormatter;
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
        $stream->setFormatter(new \Monolog\Formatter\JsonFormatter());
        $this->logger->pushHandler($stream);
    }

    public function __call($name, $args)
    {
        if (!method_exists($this->logger, $name)) {
            throw new InvalidLoggerMethodNameException('Method `$name` not found in Monolog\Logger!');
        }
        $message = array_shift($args);
        $this->logger->$name($message, $args);
    }
}
