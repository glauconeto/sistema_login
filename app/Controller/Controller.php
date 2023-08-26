<?php

namespace App\Controller;

/**
 * Classe abstrata de Controller
 */
abstract class Controller
{
    /**
     * Método de renderização que utiliza uma view para 
     * renderizar como View do sistema
     */
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