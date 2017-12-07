<?php
 
namespace SlimBase\Tables;

use SlimBase\Entities\UserProfile;

class UserProfileTable {

	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}

	public function save(UserProfile $profile){
		$res = [];
		foreach ($profile->getFields() as $field) {
			$existStmt = $this->db->prepare('SELECT 1 FROM user_profiles WHERE user_id=:userId AND field_name=:fieldName LIMIT 1');
			$existStmt->execute([
				':userId'		=> $profile->getUserId(),
				':fieldName'	=> $field->getName(),
			]);
			$isFieldExist = $existStmt->fetch();

			if ($isFieldExist !== false){
				$stmt = $this->db->prepare('
					UPDATE user_profiles
					SET 
						field_value=:fieldValue,
						field_status=:fieldStatus
					WHERE user_id=:userId AND field_name=:fieldName
					'
				);
			}else{
				$stmt = $this->db->prepare('
					INSERT INTO user_profiles (user_id,field_name,field_value,field_status) 
					VALUES (:userId,:fieldName,:fieldValue,:fieldStatus)
					'
				);
			}
			$params = [
				':userId'		=> $profile->getUserId(),
				':fieldName'	=> $field->getName(),
				':fieldValue'	=> $field->getValue(),
				':fieldStatus'	=> $field->getStatus(),
			];
			$res[$field->getName()] = $stmt->execute($params);
		}

		return $res; 
	}

	public function getProfileByUserId($userId){
		$stmt = $this->db->prepare('SELECT * FROM user_profiles WHERE user_id=:userId');
		$stmt->execute([":userId"=>$userId]);
		$res = $stmt->fetchAll();

		$profile = null;
		if ($res !== false){
			$profile = UserProfile::fromData($userId, $res);
		}
		return $profile;
	}
}