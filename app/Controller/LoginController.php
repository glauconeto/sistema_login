<?php

namespace App\Controller;

use App\Model\User;

class LoginController extends Controller
{
    public function index()
    {
        
    }

    public function login()
    {
        try {
            $user = new User();

            parent::render('login');

            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
    
            $user->getUser($user->getEmail(), $user->getPassword());
        } catch (\Exception $e) {
            //throw $e;
            header('Location: http://localhost:8000');
        }
    }

    public function registerUser()
    {

    }
}