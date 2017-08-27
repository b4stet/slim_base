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
        'displayErrorDetails'    => true, //for dev only, detailed error diagnostic (stack trace) will appear in th eerror handler
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
// default
$app->get('/', function (Request $request, Response $response) {
    $response = $this->view->render($response, 'welcome.html');
    return $response;
});

// get sign in page
$app->get('/register', function (Request $request, Response $response) {
    $response = $this->view->render($response, "register.html");
    return $response;
});

// register
$app->post('/register', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $username = $data['username'];
    $password = $data['password'];
    $userTable = new UserTable($this->db);

    if (empty($password)){
        $msg = "* password cannot be empty";
        $response = $this->view->render($response, "register.html", ['msgPassword'=>$msg]);
    }elseif ($userTable->isExistUsername($username)){
        $msg = "* user already exists";
        $response = $this->view->render($response, "register.html", ['msgUsername'=>$msg]);
    }else{
        if (preg_match('/^[a-zA-Z0-9]+$/',$username) === 1){
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);
            $userTable->save($user);
            $msg = "Account successfully registered. You can now log in.";
            $response = $this->view->render($response, "register.html", ['msgRegistered'=>$msg]);    
        }else{
            $msg = "* username can only contain alphanumeric characters ([a-zA-Z0-9])";
            $response = $this->view->render($response, "register.html", ['msgUsername'=>$msg]);
        }
    }

    return $response;
});

// get login page
$app->get('/login', function (Request $request, Response $response) {
    $response = $this->view->render($response, "login.html");
    return $response;
});

// login
$app->post('/login', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $userTable = new UserTable($this->db);
    $user = $userTable->getUserByUsernameAndPassword($data['username'],$data['password']);
    if (!empty($user)){
        $msg = "You are now logged in.";
        $response = $this->view->render($response, "login.html", ['msgLoginSuccess'=>$msg]);
    }else{
        $msg = "Wrong username and/or password.";
        $response = $this->view->render($response, "login.html", ['msgLoginFailed'=>$msg]);
    }

});

// resources list
$app->get('/resources/list', function (Request $request, Response $response) {
    //is user logged in ?
    $response->getBody()->write("OK");
    return $response;
});

// run application
$app->run();        