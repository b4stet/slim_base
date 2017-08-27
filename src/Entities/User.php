<?php
 
namespace SlimBase\Entities;

class User {

	protected $userId;
	protected $username;
	protected $password;
	protected $salt;

	public function __construct(){
	}

	public function getUserId(){
		return $this->userId; 
	}

	public function setUserId($id){
		$this->userId = $id; 
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username; 
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password; 
	}

	public function getSalt(){
		return $this->salt;
	}

	public function setSalt($salt){
		$this->salt = $salt; 
	}
}