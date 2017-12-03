<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserProfileTable;
use SlimBase\Entities\UserProfile;

class ProfilePostAction extends AbstractAction{

	public function doPostProfile(Request $request, Response $response){
		if (!isset($_SESSION['userId'])){
			throw new Exception('No key userId found in $_SESSION',500);
		}

	    $data = $request->getParsedBody();
	    $profile = new UserProfile();
	    $profile->setUserId($_SESSION['userId']);
		$profile->setFullname(isset($data['fullname']) ? $data['fullname'] : '');
		$profile->setFullnameStatus(isset($data['fullname_status']) ? $data['fullname_status'] : '');
		$profile->setGithublink(isset($data['githublink']) ? $data['githublink'] : '');
		$profile->setGithublinkStatus(isset($data['githublink_status']) ? $data['githublink_status'] : '');

	    $profileTable = new UserProfileTable($this->service['db']);
	    $profileTable->save($profile);

	    return $response->withRedirect('/profile/' . $_SESSION['userId']);
	}
}