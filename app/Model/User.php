<?php

namespace App\Model;

use Lib\Database\Connection;
use Lib\Database\LoginDao;
use Lib\Database\UserDao;
use PDO;

/**
 * Model da aplicação
 *
 * Aqui vai a regra geral de todo o banco de dados, que irá ser utilizado pelo Controller.
 *
 * 
 */
class User extends Connection
{
    private $id;
    private $name;
    private $email;
    private $password;
    // protected $connect;

    // public function __construct($id = null, $name = null, $email = null, $password = null)
    // {
    //     $this->id = $id;
    //     $this->name = $name;
    //     $this->email = $email;
    //     $this->password = $password;
    // }

    /**
     * Pega um usuário do banco,
     * a partir do e-mail e senha
     * para realizar o login
     * @param string email
     * @param string password
     */
    public function logInUser()
    {
        $dao = new LoginDao();

        $userData = $dao->selectUser($this->getEmail(), $this->getPassword());

        $this->setId($userData['id']);
        $this->setName($userData['name']);
        // var_dump($userData);

        // if (is_object($userData)) {
        //     return $userData;
        // } else {
        //     echo 'Usuário não encontrado!';
        //     return null;
        // }

        return $this;
    }

    /**
     * registra o usuário no banco de dados
     * @param string name
     * @param string email
     * @param string password
     * 
     */
    public function registerUser()
    {
        $dao = new LoginDao();

        if ($dao->insertUser($this->getName(), $this->getEmail(), $this->getPassword())) {
            header('location: /login?sucess=true');
        } else {
            echo 'Erro ao cadastrar';

        }
    }

    // public function getUserById()
    // {
    //     $dao = new UserDao();
    //     $user = $dao->getUserById($id);


    // }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function setHashedPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}