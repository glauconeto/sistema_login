<?php

namespace App\Controller;

abstract class Controller
{
    protected static function render($view)
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
}