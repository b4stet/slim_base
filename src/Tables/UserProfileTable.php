<?php
 
namespace SlimBase\Tables;

use SlimBase\Entities\UserProfile;

class UserProfileTable {

	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}

//:fullname,:githublink,:fullname_status,:githublink_status
	public function save(UserProfile $profile){
		$params = [
			':user_id' 				=> $profile->getUserId(),
			':fullname' 			=> $profile->getFullname(),
			':fullname_status'		=> $profile->getFullnameStatus(),
			':githublink'			=> $profile->getGithublink(),
			':githublink_status' 	=> $profile->getGithublinkStatus()
		];

		if ($this->isExistUserId($profile->getUserId())){
			$stmt = $this->db->prepare('
				UPDATE user_profiles 
				SET fullname=:fullname, githublink=:githublink, fullname_status=:fullname_status, githublink_status=:githublink_status
				WHERE users_user_id=:user_id
				'
			);
		}else{
			$stmt = $this->db->prepare('
				INSERT INTO user_profiles
				(users_user_id,fullname,githublink,fullname_status,githublink_status)
				VALUES (:user_id,:fullname,:githublink,:fullname_status,:githublink_status)
				'
			);
		}

		return $stmt->execute($params); 
	}

	public function isExistUserId($userId){
		$stmt = $this->db->prepare('SELECT * FROM user_profiles WHERE users_user_id=:userId LIMIT 1');
		$stmt->execute([":userId"=>$userId]);
		$res = $stmt->fetch();

		$isExist = false;		
		if ($res !== false){
			$isExist = true;
		}
		return $isExist;
	}

	public function getProfileByUserId($userId){
		$stmt = $this->db->prepare('SELECT * FROM user_profiles WHERE users_user_id=:userId LIMIT 1');
		$stmt->execute([":userId"=>$userId]);
		$res = $stmt->fetch();

		$profile = null;
		if ($res !== false){
			$profile = new UserProfile();
			$profile->setUserId($res['users_user_id']);
			$profile->setFullname($res['fullname']);
			$profile->setFullnameStatus($res['fullname_status']);
			$profile->setGithublink($res['githublink']);
			$profile->setGithublinkStatus($res['githublink_status']);

		}
		return $profile;
	}
}