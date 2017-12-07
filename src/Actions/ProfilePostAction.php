<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserProfileTable;
use SlimBase\Entities\UserProfile;
use SlimBase\Entities\FieldProfile;

class ProfilePostAction extends AbstractAction{

	public function doPostProfile(Request $request, Response $response){
		if (!isset($_SESSION['userId'])){
			throw new Exception('No key userId found in $_SESSION',500);
		}

	    $data = $request->getParsedBody();

	    $profile = new UserProfile();
	    $profile->setUserId($_SESSION['userId']);

	    $profile->setField(
	    	FieldProfile::FIELD_NAME_FULLNAME,
	    	isset($data['fullname']) ? $data['fullname'] : '',
	    	$data['fullname_status'] === FieldProfile::FIELD_STATUS_PUBLIC ? FieldProfile::FIELD_STATUS_PUBLIC : FieldProfile::FIELD_STATUS_PRIVATE
	    );

	    $profile->setField(
	    	FieldProfile::FIELD_NAME_GITHUBLINK,
	    	isset($data['githublink']) ? $data['githublink'] : '',
	    	isset($data['githublink_status']) ? $data['githublink_status'] : FieldProfile::FIELD_STATUS_PRIVATE
	    );
	    $profileTable = new UserProfileTable($this->service['db']);
	    $profileTable->save($profile);

	    return $response->withRedirect('/profile/' . $_SESSION['userId']);
	}
}