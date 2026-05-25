<?php

define('BASE_PATH', dirname(__DIR__));   #base path for all


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);  #url
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);


/*
check if pages is not in root folder, if not get the file path only without its parent

*/
if ($scriptDir !== '/' && str_starts_with($path, $scriptDir)) { 
    $path = substr($path, strlen($scriptDir));   
} 

$path = '/' . trim($path, '/');

//Controllers
require BASE_PATH . '/app/controllers/AuthController.php';
require BASE_PATH . '/app/controllers/ProfileController.php';

$authController = new AuthController();
$profileController = new ProfileController();

#routes
switch ($path) {
    case '/':
    case '/index':
        if(!isLoggedIn()){
            header('Location: login');
            exit;
        }


        require BASE_PATH . '/app/views/landing.php';
        break;

    case '/profile':

        $profileController->show();
        
        break;

    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;

    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->showRegister();
        }
        break;


    case '/logout';
        $authController->logout();
        break;

    default:
        http_response_code(404);
        require BASE_PATH . '/app/views/errors/404.php';
        break;
}