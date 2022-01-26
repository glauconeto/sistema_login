<?php

namespace App\Controller;

use App\Model\User;

class LoginController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => true,
        ]);
        $template = $twig->load('login.html');

        return $template->render();
    }

    public function check()
    {
        try {
            //code...
            $user = new User;
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->validateLogin();
        } catch (\Exception $e) {
            //throw $e;
            header('Location: http://localhost/sistema_login/');
        }
    }
}