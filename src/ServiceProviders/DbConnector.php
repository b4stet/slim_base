<?php

namespace SlimBase\ServiceProviders;

use PDO;

class DbConnector{

	protected $pdo;

	public function __construct(array $dbSettings){
		$dsn = "mysql:host=" . $dbSettings['host'] . ";dbname=" . $dbSettings['dbname'];
		$user = $dbSettings['user'];
		$pass = $dbSettings['pass'];
	    $this->pdo = new PDO($dsn, $user, $pass);
	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	public function getPDO() {
		return $this->pdo;
	}

	public function prepare($args) {
		return $this->pdo->prepare($args);
	}
}
