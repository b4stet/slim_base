<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserProfileTable;
use SlimBase\Tables\UserAccountTable;
//use SlimBase\Entities\UserProfile;
use Exception;

class ProfileGetAction extends AbstractAction{

	public function doGetProfile(Request $request, Response $response){

		if (!isset($_SESSION['userId'])){
			throw new Exception('No key userId found in $_SESSION',500);
		}
		
		//get requested profile data and username
		$requestedUserId = $request->getAttribute('userId');
		$profileTable = new UserProfileTable($this->service["db"]);
		$accountTable = new UserAccountTable($this->service['db']);

		$responseData = [
			"isEditable"=> $requestedUserId === $_SESSION['userId'],
			"profile"	=> $profileTable->getProfileByUserId($requestedUserId),
			"user"		=> $accountTable->getUserByUserId($requestedUserId)
		];

		return $this->service['view']->render($response, 'profile.html', $responseData);
	}
}