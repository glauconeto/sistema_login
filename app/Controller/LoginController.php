<?php

namespace App\Controller;

use App\Model\User;
use Lib\Database\LoginDao;
use Lib\Database\UserDao;

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
        session_start();
        // $_SESSION['userIn'] = false;
        // $_SESSION['id'] = null;
        $context['titulo'] = 'SMART INT TECH - Sistema de login e registro.';
        if ($_SESSION['userIn'] == true){
            $userDao = new UserDao();
            $user = $userDao->getUserById($_SESSION['id']);
            $context['user'] = $user;
            $context['subtitulo'] = 'Seja bem vindo '. $user->getname() .' para acessar seu perfil <a href="/profile">clique aqui</a>';
        } else {
            $context['subtitulo'] = 'Você precisa realizar o login para acessar sistema.';
        }
        
        $dir = dirname(__DIR__, 1);

        // include $dir . '/View/index.php';
        parent::render('index', $context);
    }
    
    /**
     * Método para fazer login no sistema
     */
    public static function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
    
                $user = self::testLoginParams();
                // var_dump($user);
    
                if ($user->logInUser()) {
                    session_start();
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['userIn'] = true;
                    // $context['id'] = $user->getId();

                    header('location: /');
                    // parent::render('logged', $context);
                } else {
                    $error = 'Erro ao fazer login, tente novamente.'; 
                }
    
            } catch (\Exception $e) {
                throw $e;
                $error = 'Erro ao fazer login, tente novamente.';
            }
        } else {
            if (isset($error)) {
                $_SESSION['error'] = $error;
            }
            parent::render('login');
        }

    }

    public static function profile()
    {
        session_start();

        if (isset($_SESSION['id'])) {
            $userDao = new UserDao();
            $user = $userDao->getUserById($_SESSION['id']);
            $context['user'] = $user;
            if (isset($user)){
                parent::render('profile', $context);
            } else {
                echo 'Não pegou o user.';
            }
        } else {
            parent::render('login');
        }
    }

    /**
     * Registra o usuário com os parâmetros passados
     * na requisição
     */
    // public static function registerUser()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         try {
    //             parent::render('register');
                
    //             $user = self::testRegisterParams();
    
    //             $user->registerUser();
    
    //             $_SESSION['userIn'] = true;
    //             header('location: /login');
    //         } catch (\Exception $e) {
    //             throw $e;
    //             header('location: /');
    //         }
    //     } else {
    //         // parent::render('register'');
    //         echo 'Não é post';
    //     }

    // }

    public static function loadRegisterForm()
    {
        parent::render('register');
    }

    public static function saveRegisterForm()
    {
        try {
            $user = self::testRegisterParams();

            $user->registerUser();

            $_SESSION['userIn'] = true;
            header('location: /login');
        } catch (\Exception $e) {
            throw $e;
            header('location: /');
        }
    }
    
    /**
     * Verifica os parâmetros passados na requisição antes de processar
     * a inserção no banco
     */
    public static function testRegisterParams()
    {
        $user = new User();

        // Verifica se o campo de e-mail não está em branco
        if (empty(trim($_POST["name"]))) {
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
            $user->setHashedPassword($_POST['password']);
        }

        return $user;
    }

    public static function testLoginParams()
    {
        $user = new User();

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
        return $user;
    }
}