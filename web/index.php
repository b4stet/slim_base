<?php
require_once '../vendor/autoload.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use SlimBase\Tables\UserTable;
use SlimBase\Entities\User;
use SlimBase\Handlers\DefaultErrorHandler;


 

/* config key/values */
$config = [
    'settings' => [
        'displayErrorDetails'    => true, //for dev only, detailed error diagnostic (stack trace) in default Slim error handler
        'addContentLengthHeader' => false,
        'db'   => [
            'dbname' => 'slim_base',
            'host'   => "mysql",
            'user'   => 'slim',
            'pass'   => 'slim'
        ],
    ]
];

/*instantiate App */
$app = new \Slim\App($config);

/* fetch dependencies injection container and register service provider*/
$container = $app->getContainer();
// db connection service
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],$db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
// template renderer service
$container['view'] = function($c){
    return new \Slim\Views\PhpRenderer('../templates/');
};
// change the default Slim error handlers service
unset($app->getContainer()['errorHandler']);
$container['errorHandler'] = function($c){
    return new DefaultErrorHandler();
};


/* routes callback */
$app->get('/', function (Request $request, Response $response) {
    $response = $this->view->render($response, 'welcome.html');
    return $response;
});

$app->get('/register', function (Request $request, Response $response) {
    $response = $this->view->render($response, "register.html");
    return $response;
});

$app->post('/register', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $username = $data['username'];
    $password = $data['password'];
    $userTable = new UserTable($this->db);

    if (empty($password)){
        $msg = "* password cannot be empty";
        $response = $this->view->render($response, "register.html", ['msgPassword'=>$msg]);
    }elseif (!empty($userTable->getUserByUsername($username)->getUserId())){
        $msg = "* user already exists";
        $response = $this->view->render($response, "register.html", ['msgUsername'=>$msg]);
    }else{
        if (preg_match('/^[a-zA-Z0-9]+$/',$username) === 1){
            $user = new User($username,$password);
            $userTable->save($user);
            $msg = "Account successfully registered. You can now log in.";
            $response = $this->view->render($response, "welcome.html", ['msgWelcome'=>$msg]);    
        }else{
            $msg = "* username can only contain alphanumeric characters ([a-zA-Z0-9])";
            $response = $this->view->render($response, "register.html", ['msgUsername'=>$msg]);
        }
    }

    return $response;
});

$app->get('/login', function (Request $request, Response $response) {
    $response->getBody()->write("OK");
});


// run application
$app->run();        