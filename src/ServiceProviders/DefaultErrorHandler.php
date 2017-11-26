<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class DefaultErrorHandler extends AbstractErrorHandler{
	public function __invoke(Request $request, Response $response, Exception $exception) {
		$errorCode = empty($exception->getCode()) ? 500 : $exception->getCode();
		$this->logger->error(
			"Error ". $errorCode . " " . $exception->getMessage() . " in" . $exception->getFile() . ":" . $exception->getLine(),
			$this->getContext($request)
		);

		return $this->view->render($response->withStatus($errorCode), 'error.html', ['errorCode' => $errorCode]);


	}
}