<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserTable;
use SlimBase\Entities\User;


class LoginPostAction extends AbstractAction{

	public function doPostLogin(Request $request, Response $response){
	    $data = $request->getParsedBody();
	    $userTable = new UserTable($this->service['db']);

	    $user = $userTable->getUserByUsernameAndPassword($data['username'],$data['password']);
	    if (!empty($user)){
	        $_SESSION['isLoggedIn'] = true;
	        $_SESSION['userId'] = $user->getUserId();
	        $_SESSION['username'] = $user->getUsername();

	        $response = $response->withRedirect("/login");
	    }else{
	        $msg = "Wrong username and/or password.";
	        $response = $this->service['view']->render($response, "login.html", ['msgLoginFailed'=>$msg]);
	    }
	    return $response;
	}
}