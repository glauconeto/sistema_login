<?php

namespace App\Controller;

use App\Model\User;

class LoginController extends Controller
{
    public function index()
    {
        
    }

    public function testParams()
    {
        $user = new User();
        $error[] = [];

        // Verifica se o campo de e-mail não está em branco 
        if(empty(trim($_POST["email"]))){
            $error['email'] = "Erro de digitação no campo e-mail.";
        } else{
            $user->setPassword(trim($_POST['email']));
        }
        
        // Verifica se o campo de senha não está em branco 
        if(empty(trim($_POST["password"]))){
            $error['password'] = "Erro de digitação no campo senha.";
        } else{
            $user->setPassword($_POST['password']);
        }
    }

    public function login()
    {
        try {
            $user = new User();

            parent::render('login');

            $this->testParams();
    
            $user->getUser($user->getEmail(), $user->getPassword());
        } catch (\Exception $e) {
            //throw $e;
            header('Location: http://localhost:8000');
        }
    }

    public function registerUser()
    {
        $user = new User();

        parent::render('register');

        $this->testParams();

        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);

        $user->registerUser($user->getEmail(), $user->getPassword());
    }
}