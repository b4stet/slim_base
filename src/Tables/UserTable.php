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
		$hash = $this->hashPassword($salt,$user->getPassword());
		$stmt = $this->db->prepare('INSERT INTO users (username,password,salt) VALUES (:username,:password,:salt)');
		$params = [
			':username' => $user->getUsername(),
			':password' => $hash,
			':salt'		=> $salt
		];
		return $stmt->execute($params); 
	}

	public function isExistUsername($username){
		$stmt = $this->db->prepare('SELECT * FROM users WHERE username=:username LIMIT 1');
		$stmt->execute([":username"=>$username]);
		$res = $stmt->fetch();
		
		$isExist = false;		
		if ($res !== false){
			$isExist = true;
		}
		return $isExist;	
	}

	public function getUserByUsernameAndPassword($username, $password){
		$stmt = $this->db->prepare('SELECT * FROM users WHERE username=:username LIMIT 1');
		$stmt->execute([":username"=>$username]);
		$res = $stmt->fetch();

		$user = null;
	
		//test if user exists in db
		if($res !== false){
			$storedHash = $res['password'];
			$userHash = $this->hashPassword($res['salt'],$password);

			//verify user password			
			if(hash_equals($storedHash,$userHash)){
				$user = new User();
				$user->setUserId($res['user_id']);
				$user->setUsername($res['username']);
			}	
		}

		return $user;	
	}

	protected function hashPassword($salt,$password){
		return Hashing::generateSha512($salt.$password);
	}
}