<?php

namespace App\Controller;

abstract class Controller
{
    protected static function render($view, $model = null)
    {
        $env = parse_ini_file('.env');
        $views = $env['VIEWS'];

        $arquivo_view = $views . $view . ".html";

        if (file_exists($arquivo_view)) {
            include $arquivo_view;
        } else {
            exit('Arquivo da View não encontrado. Arquivo: ' . $view);
        }
    }

    protected static function isAuthenticated()
    {
        if(!isset($_SESSION['userIn']))
            header("location: /login");
    }
}