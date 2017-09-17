<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Throwable;


class PhpErrorHandler extends AbstractErrorHandler{
	public function __invoke(Request $request, Response $response, Throwable $error) {
		$this->logger->error(
			"Php runtime error. ". $error->getMessage() . " in " . $error->getFile() . ":" . $error->getLine(),
			$this->getContext($request)
			);

    	return $response
        	->withStatus(500)
        	->withHeader('Content-Type', 'text/html')
        	->write('Error 500 - Something went wrong! - <a href="/index.php">back to index</a>');
   		}
}