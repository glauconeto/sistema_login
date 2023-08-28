<?php

namespace App\Controller;

// Contantes usadas para acessar arquivos da view
define('BASEDIR', dirname(__FILE__, 2));
define('VIEWS', BASEDIR . '/View/');

/**
 * Classe abstrata de Controller que irá ser herdada pelos Controllers
 * para renderizar páginas de view.
 */
abstract class Controller
{
    /**
     * Método de renderização que retorna um arquivo da view,
     * além de poder usar uma variável de contexto para renderizar
     * variáveis opcionais.
     * @param string view
     * @param string context
     * @return view
     */
    protected static function render($view, $context=null)
    {
        $arquivo_view = VIEWS . $view . ".php";

        if (file_exists($arquivo_view)) {
            include $arquivo_view;
        } else {
            exit(' Arquivo da View não encontrado. Arquivo: ' . $arquivo_view);
        }
    }
}