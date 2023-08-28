<?php

use App\Controller\ErrorController;
use App\Controller\LoginController;
use App\Controller\LogoutController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/**
 * Rotas definidas do sistema
 */
switch ($url) {
    case '/':
        LoginController::index();
        break;

    case '/login':
        LoginController::login();
        break;

    case '/profile':
        LoginController::profile();
        break;

    case '/register/save':
        LoginController::saveRegisterForm();
        break;

    case '/register':
        LoginController::loadRegisterForm();
        break;
    case '/logout':
        LogoutController::logout();
        break;

    default:
        ErrorController::index();
        break;
}