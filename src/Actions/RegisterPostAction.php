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

	    $isValid = $this->isValidUsernameAndPassword($username,$password,$userTable);
	    if ($isValid[0] === true){
	            $user = new User();
	            $user->setUsername($username);
	            $user->setPassword($password);
	            $userTable->save($user);
	    }

	    return $response = $this->service['view']->render($response, "register.html", $isValid[1]);
	}

	public function isValidUsernameAndPassword($username,$password,$userTable){
		$msg = [];
		$res = true;

		//username alphanumeric only
		if (!(preg_match('/^[a-zA-Z0-9]+$/',$username) === 1)){
            $msg['msgUsernameError'] = "* Username can only contain alphanumeric characters ([a-zA-Z0-9])";
            $res = false;
		}

		//user not already exists
		if ($userTable->isExistUsername($username)){
	        $msg['msgUsernameError'] = "* User already exists";
	        $res = false;
	    }

		//password not empty
		if (empty($password)){
	        $msg['msgPasswordError'] = "* Password cannot be empty";
	        $res = false;
		}

		//set success msg
		if($res === true){
			$msg['msgRegisterSuccess'] = "Account successfully registered. You can now log in.";

		}

		return [$res,$msg];
	}
}