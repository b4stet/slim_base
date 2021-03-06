<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserAccountTable;
use SlimBase\Entities\UserAccount;


class RegisterPostAction extends AbstractAction{

	public function doPostRegister(Request $request, Response $response){
	    $data = $request->getParsedBody();
	    $username = $data['username'];
	    $password = $data['password'];
	    $userAccountTable = new UserAccountTable($this->service['db']);

	    $isValid = $this->isValidUsernameAndPassword($username,$password,$userAccountTable);
	    if ($isValid['result'] === true){
	            $user = new UserAccount();
	            $user->setUsername($username);
	            $user->setPassword($password);
	            $userAccountTable->save($user);
	    }

	    return $response = $this->service['view']->render($response, "register.html", $isValid['msg']);
	}

	public function isValidUsernameAndPassword($username,$password,$userAccountTable){
		$msg = [];
		$res = true;

		//username alphanumeric only
		if (!(preg_match('/^[a-zA-Z0-9]+$/',$username) === 1)){
            $msg['msgUsernameError'] = "! Username can only contain alphanumeric characters ([a-zA-Z0-9])";
            $res = false;
		}

		//non-existing username
		if ($userAccountTable->isExistUsername($username)){
	        $msg['msgUsernameError'] = "! User already exists";
	        $res = false;
	    }

		//password not empty
		if (empty($password)){
	        $msg['msgPasswordError'] = "! Password cannot be empty";
	        $res = false;
		}

		//set success msg
		if($res === true){
			$msg['msgRegisterSuccess'] = "Account successfully registered. You can now log in.";

		}

		return ['result'=>$res,'msg'=>$msg];
	}
}