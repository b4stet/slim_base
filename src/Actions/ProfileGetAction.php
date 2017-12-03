<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserProfileTable;
use SlimBase\Entities\UserProfile;
use Exception;

class ProfileGetAction extends AbstractAction{

	public function doGetProfile(Request $request, Response $response){

		if (!isset($_SESSION['userId'])){
			throw new Exception('No key userId found in $_SESSION',500);
		}
		if (!isset($_SESSION['username'])){
			throw new Exception('No key username found in $_SESSION',500);
		}
		
		//if requested userId == current userId, then editable, else viewable only
		$requestedUserId = $request->getAttribute('userId');
		$currentUserId = $_SESSION['userId'];
		$isEditable = ($requestedUserId === $currentUserId) ? true : false;

		//get profile data
		$profileTable = new UserProfileTable($this->service["db"]);
		$profile = $profileTable->getProfileByUserId($_SESSION['userId']);

		$responseData = [];
		$responseData["isEditable"] = $isEditable;
		$responseData["username"] = $_SESSION['username'];


		if (!empty($profile)){
			$responseData["fullname"]	 			= $profile->getFullname();
			$responseData["githublink"]				= $profile->getGithublink();
			$responseData["isFullnamePublic"] 		= $profile->getFullnameStatus() == UserProfile::PROFILE_STATUS_PUBLIC ? true : false;
			$responseData["isGithublinkPublic"]		= $profile->getGithublinkStatus() == UserProfile::PROFILE_STATUS_PUBLIC ? true : false;
		}else{
			$responseData["fullname"]	 			= '';
			$responseData["githublink"]				= '';
			$responseData["isFullnamePublic"] 		= false;
			$responseData["isGithublinkPublic"]		= false;
		}

		return $this->service['view']->render($response, 'profile.html', $responseData);
	}
}