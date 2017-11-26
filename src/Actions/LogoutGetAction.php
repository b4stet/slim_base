<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;


class LogoutGetAction extends AbstractAction{

	public function doGetLogout(Request $request, Response $response){
		//delete session
		session_destroy();

		//redirect to index page
		return $response->withRedirect('/');
	}
}
