<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;


define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$container = new FactoryDefault();


include APP_PATH . '/config/services.php';
include APP_PATH . '/config/loader.php';


$application = new Application($container);
try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}