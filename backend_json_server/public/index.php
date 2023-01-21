<?php

header("Access-Control-Allow-Origin: http://localhost:8081");
header('Access-Control-Allow-Headers: Content-Type');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header('Access-Control-Allow-Credentials: true');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once __DIR__.'/../vendor/autoload.php';
require_once '../config/database.php';

$config = get_config();


$modelFactory = new App\Factory\ModelFactory();
$controllerFactory = new App\Factory\ControllerFactory($modelFactory);
$request = new App\Request\Request();
$router = new App\Route\Router($request,$controllerFactory);

$router->get('/', 'UserController@index');
$router->get('/users/', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users/', 'UserController@store');


$router->run();