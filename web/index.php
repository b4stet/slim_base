<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/settings.php';
require_once __DIR__.'/../config/routing.php';
use Slim\App;

// instantiate app and register service providers
$app = new App($appConfig);
$container = $app->getContainer();
foreach ($diContainers as $name => $service){
    $container[$name] = function ($c) use ($service){
        return $service;
    };
}

// routes
foreach ($actions as $action => $conf){
    $route = $conf['route'];
    $method = $conf['method'];
    $function = $conf['function'];
    $name = end(explode('\\',$action));
    $services = [];
    foreach ($conf['services'] as $service){
        $services[$service] = $container->get($service);
    }
    $container[$name] = function ($c) use ($action,$services){
        return new $action($services);
    };
    $app->map([$method],$route,$name.':'.$function);
}

// run application
$app->run();        