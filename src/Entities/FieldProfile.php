<?php
 
namespace SlimBase\Entities;

use Exception;

class FieldProfile{
	const FIELD_STATUS_PUBLIC 	= 'public';
	const FIELD_STATUS_PRIVATE 	= 'private';

	const FIELD_NAME_FULLNAME 	= 'fullname';
	const FIELD_NAME_GITHUBLINK	= 'githublink';
	const FIELD_LABELS 			= [
		self::FIELD_NAME_FULLNAME	=> 'Full Name',
		self::FIELD_NAME_GITHUBLINK	=> 'Github',
	];

	protected $name;
	protected $value;
	protected $status;

	public function __construct($name,$value,$status){

		if (!array_key_exists($name,FieldProfile::FIELD_LABELS)){
			throw new Exception('field name ' . $name . ' does not exist');
		}
		$this->name 	= $name;
		$this->value 	= $value;
		$this->status = $status === self::FIELD_STATUS_PUBLIC ? $status : self::FIELD_STATUS_PRIVATE;
	}

	public function getName(){
		return $this->name;
	}

	public function getValue(){
		return $this->value;
	}

	public function getStatus(){
		return $this->status;
	}


}