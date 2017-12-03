<?php

return [
	'public' => [
		'middlewares' 	=> [],
		'routes' 		=> [
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
			'SlimBase\Actions\LoginPostAction' => [
				'route'  => '/login',
				'method' => 'POST',
				'function' => 'doPostlogin',
				'services' => array('view','db')
			],
			'SlimBase\Actions\LogoutGetAction' => [
				'route'  => '/logout',
				'method' => 'GET',
				'function' => 'doGetLogout',
				'services' => array('view')
			],
		]
	],

	'private' => [
		'middlewares' 	=> [
			new SlimBase\Middlewares\IsLoggedInMiddleware,
		],
		'routes' 		=> [
			'SlimBase\Actions\ResourcesListGetAction' => [
				'route'  => '/resources/list',
				'method' => 'GET',
				'function' => 'doGetListResources',
				'services' => array('view')
			],
			'SlimBase\Actions\ProfileGetAction' => [
				'route'  => '/profile/{userId}',
				'method' => 'GET',
				'function' => 'doGetProfile',
				'services' => array('view','db')
			],
			'SlimBase\Actions\ProfilePostAction' => [
				'route'  => '/profile/{userId}',
				'method' => 'POST',
				'function' => 'doPostProfile',
				'services' => array('view','db')
			],
		]
	]
];