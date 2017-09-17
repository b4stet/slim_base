<?php

// verbosity in logs and display
// env: 'DEV'|'PROD'
// log level: 'DEBUG'|'INFO'|'NOTICE'|'WARNING'|'ERROR'|'CRITICAL'|'ALERT'
// if 'dev', detailed error diagnostic (stack trace) will appear in the error handler
$env = 'PROD';
$logLevel = 'DEBUG';

// db config
$dbSettings = [
    'dbname' => 'slim_base',
    'host'   => "mysql",
    'user'   => 'slim',
    'pass'   => 'slim'	
];

// paths
$templatesPath = __DIR__.'/../templates/';
$logFile       = __DIR__.'/../logs/app.log';



/********************/
// Slim app settings
$appConfig = [
    'settings' => [
        'displayErrorDetails'    => $env === 'DEV', 
        'addContentLengthHeader' => false,
    ]
];

//DI containers for services
$logger = new SlimBase\ServiceProviders\DefaultLogger($logFile,$logLevel);

$diContainers = [
    'db'              => new SlimBase\ServiceProviders\DbConnector($dbSettings),
	'view'            => new Slim\Views\PhpRenderer($templatesPath),
    'logger'          => $logger,
	'errorHandler'    => new SlimBase\ServiceProviders\DefaultErrorHandler($logger),
	'notFoundHandler' => new SlimBase\ServiceProviders\NotFoundErrorHandler($logger)
];


