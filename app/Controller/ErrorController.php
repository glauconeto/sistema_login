<?php

namespace App\Controller;

abstract class ErrorController extends Controller
{
    public static function index()
    {
        parent::render('404');
    }
}