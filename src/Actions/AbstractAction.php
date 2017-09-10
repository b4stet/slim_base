<?php

namespace SlimBase\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class AbstractAction{
	protected $service;

	public function __construct(array $services){
		foreach ($services as $name => $obj){
			$this->service[$name] = $obj;
		}
	}

}
