<?php

namespace SlimBase\Middlewares;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class IsLoggedInMiddleware{
	function __invoke($request, $response, $next) {
	    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){
	        $response = $next($request, $response);
	    }else{
	    	throw new Exception("Unauthorized access",403);
	    }

	    return $response;
	}
}