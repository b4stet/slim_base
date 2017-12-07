<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserAccountTable;
//use SlimBase\Entities\UserAccount;


class LoginPostAction extends AbstractAction{

	public function doPostLogin(Request $request, Response $response){
	    $data = $request->getParsedBody();
	    $userAccountTable = new UserAccountTable($this->service['db']);

	    $user = $userAccountTable->getUserByUsernameAndPassword($data['username'],$data['password']);
	    if (!empty($user)){
	        $_SESSION['isLoggedIn'] = true;
	        $_SESSION['userId'] = $user->getUserId();

	        $response = $response->withRedirect("/login");
	    }else{
	        $msg = "Wrong username and/or password.";
	        $response = $this->service['view']->render($response, "login.html", ['msgLoginFailed'=>$msg]);
	    }
	    return $response;
	}
}