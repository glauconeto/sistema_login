<?php

namespace App\Controller;

/**
 * Controller de erro que levará a caso 
 * a rota inserida não for encontrada no sistema.
 */
abstract class ErrorController extends Controller
{
    /**
     * Método index que irá apenas renderizar
     * a view.
     */
    public static function index()
    {
        parent::render('404.html');
    }
}