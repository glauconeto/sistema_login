<?php

namespace App\Controller;

define('BASEDIR', dirname(__FILE__, 2));
define('VIEWS', BASEDIR . '/View/');
/**
 * Classe abstrata de Controller
 */
abstract class Controller
{

    /**
     * Método de renderização que utiliza uma view para 
     * renderizar como View do sistema
     */
    protected static function render($view, $context=null)
    {
        $arquivo_view = VIEWS . $view . ".php";

        if (file_exists($arquivo_view)) {
            include $arquivo_view;
        } else {;
            exit(' Arquivo da View não encontrado. Arquivo: ' . $arquivo_view);
        }
    }
}