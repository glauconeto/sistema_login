<?php

namespace App\Controller;

abstract class LogoutController extends Controller
{
    public static function logout()
    {
        session_unset();

        parent::render('login');
    }
}