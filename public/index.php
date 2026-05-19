<?php

#base path (Musicboxd)
define('BASE_PATH', dirname(__DIR__));

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);  // get only the url path 
$scriptDir =  dirname($_SERVER['SCRIPT_NAME']);    


/*
check if pages is not in root folder, if not get the file path only without its parent

*/
if ($scriptDir !== '/' && str_starts_with($path, $scriptDir)) {
    $path = substr($path, strlen($scriptDir));  
}

$path = '/' . trim($path, '/');  

switch ($path) {
    case '/':
    case '/index':
        require BASE_PATH . '/app/views/landing.php';
        break;

    case '/login':
        require BASE_PATH . '/app/views/auth/login.php';
        break;

    case '/register':
        require BASE_PATH . '/app/views/auth/register.php';
        break;

    default:
        http_response_code(404);
        require BASE_PATH . '/app/views/errors/404.php';
        break;
}
