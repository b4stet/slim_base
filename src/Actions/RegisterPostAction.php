<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserTable;
use SlimBase\Entities\User;


class RegisterPostAction extends AbstractAction{

	public function doPostRegister(Request $request, Response $response){
	    $data = $request->getParsedBody();
	    $username = $data['username'];
	    $password = $data['password'];
	    $userTable = new UserTable($this->service['db']);

	    if (empty($password)){
	        $msg = "* password cannot be empty";
	        $response = $this->service['view']->render($response, "register.html", ['msgPasswordError'=>$msg]);
	    }elseif ($userTable->isExistUsername($username)){
	        $msg = "* user already exists";
	        $response = $this->service['view']->render($response, "register.html", ['msgUsernameError'=>$msg]);
	    }else{
	        if (preg_match('/^[a-zA-Z0-9]+$/',$username) === 1){
	            $user = new User();
	            $user->setUsername($username);
	            $user->setPassword($password);
	            $userTable->save($user);
	            $msg = "Account successfully registered. You can now log in.";
	            $response = $this->service['view']->render($response, "register.html", ['msgRegisterSuccess'=>$msg]);    
	        }else{
	            $msg = "* username can only contain alphanumeric characters ([a-zA-Z0-9])";
	            $response = $this->service['view']->render($response, "register.html", ['msgUsernameError'=>$msg]);
	        }
	    }

	    return $response;
	}
}