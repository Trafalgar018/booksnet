<?php
require_once '../vendor/autoload.php';
use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;

// Punto de entrada a la aplicación
require_once '../helpers.php';
session_start();

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

$baseUrl = $_SERVER['HTTP_HOST'] . $baseDir;
$protocol = (strpos($baseUrl, 'heroku')) ? "https://" : "http://";
$baseUrl = $protocol.$baseUrl;
define('BASE_URL', $baseUrl);

if(file_exists(__DIR__.'/../.env')){
    $dotenv = new Dotenv\Dotenv(__DIR__.'/..');
    $dotenv->load();
}


// Instancia de Eloquent
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$route = $_GET['route'] ?? "/";

$router = new RouteCollector();

// Filtro para aplicar a rutas a USUARIOS AUTENTICADOS
// en el sistema
$router->filter('auth', function(){
    if(!isset($_SESSION['userId'])){
        header('Location: '. BASE_URL);
        return false;
    }
});

$router->group(['before' => 'auth'], function ($router){
    $router->get('/books/add', ['\App\Controllers\BooksController', 'getNew']);
    $router->post('/books/add', ['\App\Controllers\BooksController', 'postNew']);
    $router->get('/books/edit/{id}', ['\App\Controllers\BooksController', 'getEdit']);
    $router->put('/books/edit/{id}', ['\App\Controllers\BooksController', 'putEdit']);
    $router->delete('/books/', ['\App\Controllers\BooksController', 'deleteIndex']);
    $router->get('/logout', ['\App\Controllers\HomeController', 'getLogout']);
});

// Filtro para aplicar a rutas a USUARIOS NO AUTENTICADOS
// en el sistema
$router->filter('noAuth', function(){
    if( isset($_SESSION['userId'])){
        header('Location: '. BASE_URL);
        return false;
    }
});

$router->group(['before' => 'noAuth'], function ($router){
    $router->get('/login', ['\App\Controllers\HomeController', 'getLogin']);
    $router->post('/login', ['\App\Controllers\HomeController', 'postLogin']);
    $router->get('/registro', ['\App\Controllers\HomeController', 'getRegistro']);
    $router->post('/registro', ['\App\Controllers\HomeController', 'postRegistro']);
    $router->get('/invitaciones', ['\App\Controllers\HomeController', 'getInvitaciones']);
    $router->post('/invitaciones', ['\App\Controllers\HomeController', 'postInvitaciones']);
});

// Rutas sin filtros
$router->get('/',['\App\Controllers\HomeController', 'getIndex']);
$router->post('/',['\App\Controllers\HomeController', 'postIndex']);
$router->get('/books/{id}', ['\App\Controllers\BooksController', 'getIndex']);
$router->controller('/api', App\Controllers\ApiController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];


$response = $dispatcher->dispatch($method, $route);


// Print out the value returned from the dispatched function
echo $response;