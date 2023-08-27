<?php

use App\Controller\ErrorController;
use App\Controller\LoginController;
use App\Controller\LogoutController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
        LoginController::index();
        break;

    case '/login':
        LoginController::login();
        break;

    case '/register':
        LoginController::registerUser();
        break;
    case '/logout':
        LogoutController::logout();

    default:
        ErrorController::index();
        break;
}