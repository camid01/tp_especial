<?php
require_once './app/controllers/buys.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


// listar       ->         buysController->showBuys();
// descripcion  ->         buysController->descriptionBuys(); 

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $view = new buysView();
        $view->showHome();
        break;
    case 'listar':
        $controller = new buysController();
        $controller->showBuys();
        break;
    case 'ampliar':
        $controller = new buysController();
        $controller->descriptionBuys($params[1]);
        break;
    case 'registro':
        $controller = new AuthController();
        $controller->showRegistro(); 
        break;
    case 'registrar':
        $controller = new AuthController();
        $controller->registro(); 
        break;
        
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        $view = new buysView();
        $view->showError('404 Not Found');
        break;
}