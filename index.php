<?php

use \src\App\Controller as Controller,
    \view\View as View,
    \src\App\Application as Application,
    \src\App\Router as Router;

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
require_once APP_DIR . '/view/View.php';

$router = new Router();

$router->get('/', function() {
    return new View('index', ['title' => 'Главная']);
});

$router->get('/authentication', function() {
    return new View('authentication', ['title' => 'Авторизация']);
});

$router->get('/addTask', function() {
    return new View('addtask', ['title' => 'Добавить задачу']);
});

$router->get('/editTask/*', function($id) {
    return new View('edittask', ['id' => $id, 'permissions' => 1]);
});

$router->post('/saveEditedTask/*', function($id) {
    return new View('edittask', ['id' => $id, 'permissions' => 1]);
});

$router->get('/setTaskDone/*', function($id) {
    return (new ReflectionMethod('\src\App\Controller', 'setTaskDone'))->invokeArgs(null, ['id' => $id, 'permissions' => 1]);
});

$router->post('/publishTask', Controller::class . '@publishTask');
$router->post('/authenticate', Controller::class . '@authenticate');
$router->get('/logout', Controller::class . '@logout');

$application = new Application($router);

$application->initialize();
$application->run();
