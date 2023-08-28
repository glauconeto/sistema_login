<?php

namespace App\Controller;

/**
 * Controler de logout para quando
 * usuário requisitar encerrar a sessão.
 */
abstract class LogoutController extends Controller
{
    /**
     * Método de logout que desativa toda a sessão 
     * definida anteriormente e retorna o usuário 
     * para a view de login.
     */
    public static function logout()
    {
        session_start();
        session_unset();

        parent::render('login');
    }
}