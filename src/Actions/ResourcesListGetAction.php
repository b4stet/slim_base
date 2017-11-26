<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class ResourcesListGetAction extends AbstractAction{

	public function doGetListResources(Request $request, Response $response){
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){
			$response = $this->service['view']->render($response, "resourcesList.html", ['msgIsAuthorized'=> true]);
		}else{
			$response = $this->service['view']->render($response, "resourcesList.html", ['msgIsAuthorized'=> false]);
		}
		return $response;
	}
}