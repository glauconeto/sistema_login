<?php

namespace App\Model;

use Lib\Database\Connection;
use Lib\Database\LoginDao;

/**
 * Model de usuário da aplicação.
 * Aqui vai a regra geral de todo o banco de dados, 
 * que irá ser utilizado pelo Controller.
 */
class User extends Connection
{
    private $id;
    private $name;
    private $email;
    private $password;

    /**
     * Pega um usuário do banco, a partir do e-mail e senha.
     * para realizar o login.
     * @param string email
     * @param string password
     * @return object this
     */
    public function logInUser()
    {
        $dao = new LoginDao();

        $userData = $dao->selectUser($this->getEmail(), $this->getPassword());

        $this->setId($userData['id']);
        $this->setName($userData['name']);

        return $this;
    }

    /**
     * Registra o usuário no banco de dados.
     * @param string name
     * @param string email
     * @param string password
     * @return redirect
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

    /**
     * Método modificador set de password
     * fazendo hash da senha passada na requisição
     * @param string password
     */
    public function setHashedPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}