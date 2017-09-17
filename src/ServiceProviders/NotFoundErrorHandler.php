<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class NotFoundErrorHandler extends AbstractErrorHandler{
	public function __invoke(Request $request, Response $response) {
		$this->logger->info('Error 404.',$this->getContext($request));

    	return $response
        	->withStatus(404)
        	->withHeader('Content-Type', 'text/html')
        	->write('Error 404 - Not found - <a href="/index.php">back to index</a>');
   	}	
}