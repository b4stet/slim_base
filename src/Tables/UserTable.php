<?php
 
namespace SlimBase\Tables;

use SlimBase\Entities\User as User;
use SlimBase\Utils\Randomness as Randomness;
use SlimBase\Utils\Hashing as Hashing;
use Exception;

class UserTable {

	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}

	
	public function save(User $user){

		$salt = Randomness::generateBytes(32);
		$password = Hashing::generateSha512($salt . $user->getPassword());

		try{
			$stmt = $this->db->prepare('INSERT INTO users (username,password,salt) VALUES (:username,:password,:salt)');
			$params = [
				':username' => $user->getUsername(),
				':password' => $password,
				':salt'		=> $salt
			];
			$res = $stmt->execute($params); 
		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}
	}


	public function getUserById($userId){
		$stmt = $this->db->prepare('SELECT * FROM users WHERE user_id=:userId LIMIT 1');
		$res = $stmt->execute([":userId"=>$userId]);
		if ($res !== true){
			throw new Exception("[getUserById] failed to find user_id = ".$userId);
		}

		$user = $stmt->fetch();
		return new User($user['username'],$user['password'],$user['user_id']);
	}

	public function getUserByUsername($username){
		$stmt = $this->db->prepare('SELECT * FROM users WHERE username=:username');
		$res = $stmt->execute([":username"=>$username]);
		if ($res !== true){
			throw new Exception("[getUserByUsername] failed to find username = ".$username);
		}

		$user = $stmt->fetch();
		return new User($user['username'],$user['password'],$user['user_id']);	
	}
}