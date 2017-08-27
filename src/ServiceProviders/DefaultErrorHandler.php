<?php

namespace SlimBase\ServiceProviders;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Exception;

class DefaultErrorHandler{
	public function __invoke(Request $request, Response $response, Exception $exception) {
		//TODO: log error message
    	return $response
        	->withStatus(500)
        	->withHeader('Content-Type', 'text/html')
        	->write('Error 500 - Something went wrong! - <a href="/index.php">back to index</a>');
   		}
}