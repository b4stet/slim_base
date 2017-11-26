<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class NotFoundErrorHandler extends AbstractErrorHandler{
	public function __invoke(Request $request, Response $response) {
		$this->logger->info('Error 404.',$this->getContext($request));

		return $this->view->render($response->withStatus(404), 'error.html', ['errorCode'=>404]);
   	}	
}