<?php
 
namespace SlimBase\Entities;

use SlimBase\Entities\FieldProfile;

class UserProfile {

	protected $userId;
	protected $fields;

	// protected $fullname;
	// protected $fullnameStatus;
	// protected $githublink;
	// protected $githublinkStatus;

	public function __construct(){
		$this->fields = [];
	}

	public function getUserId(){
		return $this->userId; 
	}

	public function setUserId($id){
		$this->userId = $id; 
	}

	public function getFields(){
		return $this->fields;
	}


	public function getField($fieldName){
		return $this->fields[$fieldName];
	}

	public function setField($name,$value,$status){
		$this->fields[$name] = new FieldProfile($name,$value,$status);
	}

	static public function fromData($userId, $data = array()){
		$profile = new UserProfile();
		$profile->setUserId($userId);

		foreach ($data as $field){
			$profile->setField($field['field_name'],$field['field_value'],$field['field_status']);
		}

		return $profile;
	}
}