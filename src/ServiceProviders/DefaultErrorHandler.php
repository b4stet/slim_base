<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class DefaultErrorHandler{
	protected $logger;

	public function __construct(DefaultLogger $logger){
		$this->logger = $logger->getLogger();
	}

	public function __invoke(Request $request, Response $response, Exception $exception) {
		$this->logger->error("500 error occured.",["msg"=> $exception->getMessage()]);

    	return $response
        	->withStatus(500)
        	->withHeader('Content-Type', 'text/html')
        	->write('Error 500 - Something went wrong! - <a href="/index.php">back to index</a>');
   		}
}