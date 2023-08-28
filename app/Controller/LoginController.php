<?php

namespace App\Controller;

use App\Model\User;
use Lib\Database\UserDao;

/**
 * Controller do sistema, com toda a lógica do sistema "conversando"
 * com banco e retornando para a View
 */
class LoginController extends Controller
{
    /**
     * Método index que renderiza a página principal do sistema
     */
    public static function index()
    {
        session_start();
        $context['titulo'] = 'SMART IN TECH - Sistema de login e registro.';
        
        if ($_SESSION['userIn'] == true){
            $userDao = new UserDao();
            $user = $userDao->getUserById($_SESSION['id']);
            $context['user'] = $user;
            $context['subtitulo'] = 'Seja bem vindo '. $user->getname() .' para acessar seu perfil <a href="/profile">clique aqui</a>';
        } else {
            $context['subtitulo'] = 'Você precisa realizar o login para acessar sistema.';
        }
        
        parent::render('index', $context);
    }
    
    /**
     * Método para fazer login no sistema,
     * primeiro fazendo um teste dos parâmetros 
     * e iniciando a sessão caso não dê nenhum erro.
     */
    public static function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
    
                $user = self::testLoginParams();
    
                if ($user->logInUser()) {
                    session_start();
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['userIn'] = true;

                    header('location: /');
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
        }
        $context['titulo'] = 'Login - Sistema de login e registro';

        parent::render('login', $context);
    }

    /**
     * Método de profile onde o usuário poderá ver suas
     * informações inseridas registro, em uma página de
     * perfil.
     */
    public static function profile()
    {
        session_start();

        if (isset($_SESSION['id'])) {
            $userDao = new UserDao();
            $user = $userDao->getUserById($_SESSION['id']);
            $context['user'] = $user;
            $context['titulo'] = 'Perfil de usuário - Sistema de login e registro';
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
     * Método de carregamento da view de registro,
     * com o formulário.
     */
    public static function loadRegisterForm()
    {
        parent::render('register');
    }

    /**
     * Método de salvar informações do formulário de registro
     * de usuário.
     */
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
     * Método de verificação, com os parâmetros
     * passados na requisição antes de processar
     * a inserção no banco.
     */
    public static function testRegisterParams()
    {
        $user = new User();

        // Verifica se o campo de nome não está em branco
        if (empty(trim($_POST["name"]))) {
            $error = "Campo nome precisa estar preenchido.";

            return $_SESSION['error'] = $error;
        } else {
            $user->setName(trim($_POST['name']));
        }

        // Verifica se o campo de e-mail não está em branco 
        if (empty(trim($_POST["email"]))) {
            $error = "Campo e-mail precisa estar preenchido.";

            return $_SESSION['error'] = $error;
        } else {
            $user->setEmail(trim($_POST['email']));
        }
        
        // Verifica se o campo de senha não está em branco 
        if (empty(trim($_POST["password"]))) {
            $error = "Campo senha precisa estar preenchido.";

            return $_SESSION['error'] = $error;
        } else {
            $user->setHashedPassword($_POST['password']);
        }

        return $user;
    }

    /**
     * Método de verificação dos parâmetros
     * passados na requisição.
     */
    public static function testLoginParams()
    {
        $user = new User();

        // Verifica se o campo de e-mail não está em branco 
        if (empty(trim($_POST["email"]))) {
            $error = "Campo e-mail precisa estar preenchido.";

            return $_SESSION['error'] = $error;
        } else {
            $user->setEmail(trim($_POST['email']));
        }
        
        // Verifica se o campo de senha não está em branco 
        if (empty(trim($_POST["password"]))) {
            $error = "Campo senha precisa estar preenchido.";

            return $_SESSION['error'] = $error;
        } else {
            $user->setPassword($_POST['password']);
        }
        return $user;
    }
}