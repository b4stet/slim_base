<?php

// verbosity in logs and display
// env: 'DEV'|'PROD'
// log level: 'DEBUG'|'INFO'|'NOTICE'|'WARNING'|'ERROR'|'CRITICAL'|'ALERT'
// if 'DEV', detailed error diagnostic (stack trace) will appear in the error handler
$env = 'DEV';
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
$twigview = new Slim\Views\Twig($templatesPath);
$twigview->getEnvironment()->addGlobal("session", $_SESSION);

$diContainers = [
    'db'              => new SlimBase\ServiceProviders\DbConnector($dbSettings),
    'view'            => $twigview,
];

if ($env === 'PROD'){
    $logger = new SlimBase\ServiceProviders\DefaultLogger($logFile,$logLevel);

    $diContainers['logger']          = $logger;
    $diContainers['errorHandler']    = new SlimBase\ServiceProviders\DefaultErrorHandler($logger);
    $diContainers['notFoundHandler'] = new SlimBase\ServiceProviders\NotFoundErrorHandler($logger);
    $diContainers['phpErrorHandler'] = new SlimBase\ServiceProviders\PhpErrorHandler($logger);
}


