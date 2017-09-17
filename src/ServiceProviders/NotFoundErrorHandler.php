<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class NotFoundErrorHandler{
	protected $logger;

	public function __construct(DefaultLogger $logger){
		$this->logger = $logger->getLogger();
	}

	public function __invoke(Request $request, Response $response) {
		$ctx = [
			"srcIp"      => $_SERVER['REMOTE_ADDR'],
			"method"     => $_SERVER['REQUEST_METHOD'],
			"host"   	 => $_SERVER['HTTP_HOST'],
			"uri"        => $_SERVER['REQUEST_URI'],
			"userAgent"  => $_SERVER['HTTP_USER_AGENT'],
			"body"       => $request->getParsedBody()
		];
		$this->logger->info('404 error occured.',$ctx);

    	return $response
        	->withStatus(404)
        	->withHeader('Content-Type', 'text/html')
        	->write('Error 404 - Not found - <a href="/index.php">back to index</a>');
   		}	
}