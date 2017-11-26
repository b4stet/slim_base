<?php

namespace SlimBase\ServiceProviders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use Exception;

class AbstractErrorHandler{
	protected $logger;
	protected $view;

	public function __construct(DefaultLogger $logger, Twig $view){
		$this->logger = $logger->getLogger();
		$this->view   = $view;
	}

	public function getContext(Request $request){
		$body = $request->getParsedBody();
		$body = $this->filterLoggedBody($body);

		$ctx = [
			"request"    => $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
			"body"       => $body,
			"srcIp"      => $_SERVER['REMOTE_ADDR'],
			"userAgent"  => $_SERVER['HTTP_USER_AGENT']
		];
		return $ctx;
	}

	public function filterLoggedBody($body){
		if (isset($body['password'])){
			//mask 'password'
			$body['password'] = "xxx";
		}

		return $body;
	}
}