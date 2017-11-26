<?php
require_once __DIR__.'/../vendor/autoload.php';
use SlimBase\MyApp;

const ENV = 'PROD';
const LOG_LEVEL = 'DEBUG';

$config = require __DIR__ . '/../config/config.php';
$app = new MyApp($config);

$services = require __DIR__ . '/../config/services.php';
$app->registerServices($services);

$actions =  require __DIR__ . '/../config/routing.php';
foreach ($actions as $action){
    $app->registerRoutes($action['routes'],$action['middlewares']);
}

// run application
$app->run();