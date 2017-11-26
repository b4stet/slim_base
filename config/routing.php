<?php

$actions = [
	'SlimBase\Actions\IndexGetAction' => [
		'route'  => '/',
		'method' => 'GET',
		'function' => 'doGetIndex',
		'services' => array('view')
	],
	'SlimBase\Actions\RegisterGetAction' => [
		'route'  => '/register',
		'method' => 'GET',
		'function' => 'doGetRegister',
		'services' => array('view')
	],
	'SlimBase\Actions\RegisterPostAction' => [
		'route'  => '/register',
		'method' => 'POST',
		'function' => 'doPostRegister',
		'services' => array('view','db')
	],
	'SlimBase\Actions\LoginGetAction' => [
		'route'  => '/login',
		'method' => 'GET',
		'function' => 'doGetLogin',
		'services' => array('view')
	],
	'SlimBase\Actions\LogoutGetAction' => [
		'route'  => '/logout',
		'method' => 'GET',
		'function' => 'doGetLogout',
		'services' => array('view')
	],
	'SlimBase\Actions\LoginPostAction' => [
		'route'  => '/login',
		'method' => 'POST',
		'function' => 'doPostlogin',
		'services' => array('view','db')
	],
	'SlimBase\Actions\ResourcesListGetAction' => [
		'route'  => '/resources/list',
		'method' => 'GET',
		'function' => 'doGetListResources',
		'services' => array('view')
	]
];
