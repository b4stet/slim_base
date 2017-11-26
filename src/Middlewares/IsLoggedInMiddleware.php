<?php

namespace SlimBase\Middlewares;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class ForbiddenException extends Exception {
}

class IsLoggedInMiddleware{
	function __invoke($request, $response, $next) {
	    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){
	        $response = $next($request, $response);
	    }else{
	        $response
	        ->withStatus(403)
	        ->withHeader('Content-Type', 'text/html')
	        ->write('Error 403 - Forbidden - You must be logged in to access it. <a href="/index.php">back to index</a>');
	    }

	    return $response;
	}
}