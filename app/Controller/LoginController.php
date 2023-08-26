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
     * Método index para renderizar a página principal
     */
    public function index()
    {        
        parent::render('index');

        session_start();
        $_SESSION['userIn'] = false;
    }
    
    /**
     * Método para fazer login no sistema
     */
    public function login()
    {
        try {
            $user = new User();

            parent::render('login');

            $this->testParams();

            $user->getUser($user->getEmail(), $user->getPassword());

            header('location: index.php');
        } catch (\Exception $e) {
            //throw $e;
            header('Location: http://localhost:8000');
        }
    }

    /**
     * Registra o usuário com os parâmetros passados
     * na requisição
     */
    public function registerUser()
    {
        try {
            $user = new User();
            parent::render('register');
            
            $this->testParams();
            
            $user->setName($_POST['name']);
            $user->setEmail($_POST['email']);
            $user->registerUser($user->getName(), $user->getEmail(), $user->getPassword());

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
    public function testParams()
    {
        $user = new User();
        $error[] = [];

        // Verifica se o campo de e-mail não está em branco 
        if (empty(trim($_POST["email"]))) {
            $error['email'] = "Erro de digitação no campo e-mail.";
        } else {
            $user->setEmail(trim($_POST['email']));
        }
        
        // Verifica se o campo de senha não está em branco 
        if (empty(trim($_POST["password"]))) {
            $error['password'] = "Erro de digitação no campo senha.";
        } else {
            $user->setPassword($_POST['password']);
        }
    }
}