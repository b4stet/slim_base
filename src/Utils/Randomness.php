<?php
 
namespace SlimBase\Utils;

class Randomness {

	static public function generateBytes($byteLength){
		if (empty(byteLength) || (int)$byteLength < 32){
			$byteLength = 32;
		}
		return bin2hex(random_bytes((int)$byteLength));
	}
}