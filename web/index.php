<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// config key/values
$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'db' => [
            'dbname' => 'slim_base',
            'host' => "mysql",
            'user' => 'slim',
            'pass' => 'slim'
        ],
    ]
];

// instantiate App
$app = new \Slim\App($config);

// fetch dependencies injection container and register service provider
$container = $app->getContainer();
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],$db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// routes callback
$app->get('/', function () {

    print "<h1>SlimBase app - MySql status </h1>\n";

    $dbsettings = $this->get('settings')['db'];
    $tables = $this->db->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_TYPE='BASE TABLE'")->fetchAll(PDO::FETCH_COLUMN);
    if (empty($tables)) {
            print  "<p>There are no tables in database \"{$dbsettings['dbname']}\".</p>\n";
    } else {
        print  "<p>Database \"{$dbsettings['dbname']}\" has the following tables:</p>\n";
        print  "<ul>\n";
        foreach ($tables as $table) {
            print  "<li>{$table}</li>\n";
        }
        print  "</ul>\n";
    }
});

$app->get('/info', function (Request $request, Response $response) {
    $info = phpinfo();
    $response->getBody()->write(var_dump($info));
    return $response;
});


// run application
$app->run();        