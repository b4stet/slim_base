<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class IndexGetAction extends AbstractAction{

	public function doGetIndex(Request $request, Response $response){
		return $this->service['view']->render($response, 'welcome.html');
	}
}