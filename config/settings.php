<?php

// app config
$dbSettings = [
    'dbname' => 'slim_base',
    'host'   => "mysql",
    'user'   => 'slim',
    'pass'   => 'slim'	
];

$appConfig = [
    'settings' => [
        'displayErrorDetails'    => true, //for dev only, detailed error diagnostic (stack trace) will appear in th eerror handler
        'addContentLengthHeader' => false,
        'db'                     => $dbSettings
    ]
];


//DI containers for services
$diContainers = [
	'db'              => new SlimBase\ServiceProviders\DbConnector("mysql:host=" . $dbSettings['host'] . ";dbname=" . $dbSettings['dbname'],$dbSettings['user'], $dbSettings['pass']),
	'view'            => new Slim\Views\PhpRenderer(__DIR__.'/../templates/'),
	'errorHandler'    => new SlimBase\ServiceProviders\DefaultErrorHandler(),
	'notFoundHandler' => new SlimBase\ServiceProviders\NotFoundErrorHandler()
];


