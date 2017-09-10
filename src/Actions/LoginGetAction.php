<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class LoginGetAction extends AbstractAction{

	public function doGetLogin(Request $request, Response $response){
		return $this->service['view']->render($response, "login.html");
	}
}
