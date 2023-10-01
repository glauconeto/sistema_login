<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader as Loader;

/**
 * Classe abstrata de Controller que irá ser herdada pelos Controllers
 * para renderizar páginas de view.
 */
class Controller
{
    private $loader;
    private $twig;

    public function __construct()
    {
        $this->loader = new Loader('app/view');
        $this->twig = new Environment($this->loader);
    }

        
    /**
     * Método de renderização que retorna um arquivo da view,
     * além de poder usar uma variável de contexto para renderizar
     * variáveis opcionais.
     *
     * @param  string $view
     * @param  array $context
     * @return $content
     */
    public function render($view, $context=null)
    {
        $template = $this->twig->load($view);
        $content = $template->render($context);

        return $content;

        // if (file_exists($arquivo_view)) {
        //     include $arquivo_view;
        // } else {
        //     exit(' Arquivo da View não encontrado. Arquivo: ' . $arquivo_view);
        // }
    }
}