<?php

namespace App\Controller;

use App\Model\User;

/**
 * Controller do sistema, com toda a lógica do sistema "conversando"
 * com banco e retornando para a View
 */
class LoginController extends Controller
{
    /**
     * Método index que renderiza a página principal
     */
    public static function index()
    {

        parent::render('index');
        
        // session_start();
        $_SESSION['userIn'] = false;
    }
    
    /**
     * Método para fazer login no sistema
     */
    public static function login()
    {
        try {
            $user = new User();
            parent::render('login');

            self::testParams();

            if ($user->getUser($user->getEmail(), $user->getPassword())) {
                $_SESSION['id'] = $user->getName();
                $_SESSION['userIn'] = true;
    
                // header('location: ./index');
            } else {
                $error = 'Erro ao fazer login, tente novamente.'; 
            }

        } catch (\Exception $e) {
            //throw $e;
            $error = 'Erro ao fazer login, tente novamente.';
        }
    }

    /**
     * Registra o usuário com os parâmetros passados
     * na requisição
     */
    public static function registerUser()
    {
        try {
            $user = new User();
            parent::render('register');
            
            self::testParams();

            $user->setName($_POST['name']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->registerUser($user->getName(), $user->getEmail(), $user->getPassword());

            $_SESSION['userIn'] = true;
            header('location: login.php');
        } catch (\Exception $e) {
            //throw $e;
            header('location: http://localhost:8000');
        }
    }
    
    /**
     * Verifica os parâmetros passados na requisição antes de processar
     * a inserção no banco
     */
    public static function testParams()
    {
        $user = new User();

        // Verifica se o campo de e-mail não está em branco
        if (empty(trim($_POST['name']))) {
            $error = "Campo nome precisa estar preenchido.";
        } else {
            $user->setName(trim($_POST['name']));
        }

        // Verifica se o campo de e-mail não está em branco 
        if (empty(trim($_POST["email"]))) {
            $error = "Campo e-mail precisa estar preenchido.";
        } else {
            $user->setEmail(trim($_POST['email']));
        }
        
        // Verifica se o campo de senha não está em branco 
        if (empty(trim($_POST["password"]))) {
            $error = "Campo senha precisa estar preenchido.";
        } else {
            $user->setPassword($_POST['password']);
        }
    }
}