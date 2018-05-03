<?php

$loader = require __DIR__ . "/../vendor/autoload.php";
define("ROOT", dirname(__DIR__));
$loader->setPsr4("", ROOT . '/App');
try {
    \Qe\Core\Bootstrap::run();
} catch (Exception $e) {
    \Qe\Core\Logger::error($e->getMessage(), $e);
}
