<?php
 
namespace SlimBase\Entities;

class UserProfile {

	const PROFILE_STATUS_PUBLIC = 'public';
	const PROFILE_STATUS_PRIVATE = 'private';

	protected $userId;
	protected $fullname;
	protected $fullnameStatus;
	protected $githublink;
	protected $githublinkStatus;

	public function __construct(){
	}

	public function getUserId(){
		return $this->userId; 
	}

	public function setUserId($id){
		$this->userId = $id; 
	}

	public function getFullname(){
		return $this->fullname;
	}

	public function setFullname($fullname){
		$this->fullname = $fullname; 
	}

	public function getFullnameStatus(){
		return $this->fullnameStatus;
	}

	public function setFullnameStatus($fullnameStatus){
		$this->fullnameStatus = $fullnameStatus; 
	}

	public function getGithublink(){
		return $this->githublink;
	}

	public function setGithublink($githublink){
		$this->githublink = $githublink; 
	}

	public function getGithublinkStatus(){
		return $this->githublinkStatus;
	}

	public function setGithublinkStatus($githublinkStatus){
		$this->githublinkStatus = $githublinkStatus; 
	}
}