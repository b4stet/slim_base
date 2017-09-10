<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class RegisterGetAction extends AbstractAction{

	public function doGetRegister(Request $request, Response $response){
		return $this->service['view']->render($response, "register.html");
	}
}