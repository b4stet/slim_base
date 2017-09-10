<?php 

namespace SlimBase\Utils;

Class Hashing {
	static public function generateSha512($str){
		return bin2hex(hash('sha512',$str,true));
	}
}