<?php

namespace SlimBase\ServiceProviders;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DefaultLogger{

	protected $logger;

	public function __construct($logFile,$logLevel){
		$this->logger = new Logger('default_logger');
		$this->logger->pushHandler(new StreamHandler($logFile, $logLevel));
	}

	public function getLogger(){
		return $this->logger;
	}
}
