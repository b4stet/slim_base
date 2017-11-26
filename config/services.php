<?php


$logFile       = __DIR__.'/../logs/app.log';
$dbSettings = [
    'dbname' => 'slim_base',
    'host'   => "mysql",
    'user'   => 'slim',
    'pass'   => 'slim'	
];
$templatesPath = __DIR__.'/../templates/';
$twigview = new Slim\Views\Twig($templatesPath);
$twigview->getEnvironment()->addGlobal("session", $_SESSION);

$diContainers = [
    'db'              => new SlimBase\ServiceProviders\DbConnector($dbSettings),
    'view'            => $twigview,
];

if (ENV === 'PROD'){
    $logger = new SlimBase\ServiceProviders\DefaultLogger($logFile,LOG_LEVEL);

    $diContainers['logger']          = $logger;
    $diContainers['errorHandler']    = new SlimBase\ServiceProviders\DefaultErrorHandler($logger);
    $diContainers['notFoundHandler'] = new SlimBase\ServiceProviders\NotFoundErrorHandler($logger);
    $diContainers['phpErrorHandler'] = new SlimBase\ServiceProviders\PhpErrorHandler($logger);
}

return $diContainers;