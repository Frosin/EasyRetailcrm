<?php

use Logger\Logger;

require __DIR__ . "/Classes/autoload.php";

$log = new Logger("test");
$log->add("test1", "test2", "test3");
$log->add("test10", "test20", "test30");


$log2 = new Logger();
$log2->add("test1", "test2", "test3");
$log2->add("test10", "test20", "test30");
