<?php
 
namespace SlimBase\Entities;

class User {

	protected $userId;
	protected $username;
	protected $password;

	public function __construct($username, $password, $id=null){
		$this->username = $username;
		$this->password = $password;
		$this->userId = $id;
	}

	public function getUserId(){
		return $this->userId; 
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}
}