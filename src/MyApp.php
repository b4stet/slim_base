<?php

namespace SlimBase;

use Slim\App;

class MyApp extends App{
	public function __construct($config){
		parent::__construct($config);
		session_start();
	}

	public function registerServices($diContainers){
		$container = $this->getContainer();
		foreach ($diContainers as $name => $service){
		    $container[$name] = function ($c) use ($service){
		        return $service;
		    };
		}
	}

	public function registerRoutes($actions,$middlewares=array()){
	    $container = $this->getContainer();

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

	        $r = $this->map([$method],$route,$name.':'.$function); 
	        foreach ($middlewares as $middleware){
	            $r->add($middleware);
	        }
	    }
	}
}
