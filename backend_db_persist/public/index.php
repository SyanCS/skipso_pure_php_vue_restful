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

try {
    $db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}"
    , $config['username'], $config['password']);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$modelFactory = new App\Factory\ModelFactory($db);
$controllerFactory = new App\Factory\ControllerFactory($modelFactory);
$request = new App\Request\Request();
$router = new App\Route\Router($request,$controllerFactory);

$router->get('/', 'UserController@index');
$router->get('/users/', 'UserController@index');
$router->get('/users/getallwithcompany', 'UserController@getAllWithCompany');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users/', 'UserController@store');
$router->put('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');

$router->get('/companies/', 'CompanyController@index');
$router->get('/companies/{id}', 'CompanyController@show');
$router->post('/companies/', 'CompanyController@store');
$router->put('/companies/{id}', 'CompanyController@update');
$router->delete('/companies/{id}', 'CompanyController@delete');

$router->run();