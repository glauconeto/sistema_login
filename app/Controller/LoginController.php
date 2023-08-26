<?php

namespace App\Controller;

use App\Model\User;

class LoginController extends Controller
{
    public function index()
    {
        if (parent::isAuthenticated()) {
            parent::render('login');
        }

    }

    public function getUser()
    {

    }

    public function registerUser()
    {

    }
}