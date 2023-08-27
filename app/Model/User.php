<?php

namespace App\Model;

use Lib\Database\Connection;

/**
 * Model da aplicação
 *
 * Aqui vai a regra geral de todo o banco de dados, que irá ser utilizado pelo Controller.
 *
 * 
 */
class User extends Connection
{
    private $name;
    private $email;
    private $password;

    public function __construct()
    {
        Connection::class;
    }

    /**
     * Pega um usuário do banco,
     * a partir do e-mail e senha
     * para realizar o login
     * @param string email
     * @param string password
     */
    public function getUser($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email=? AND password=?';
        $stmt = $this->connect->prepare($sql);

        // Vincula as variáveis ​​à instrução preparada como parâmetros
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $password);
        $stmt->execute();

        if ($stmt->rowCount()) {
            if ($stmt->fetch()) {
                $hashed_password = $stmt["password"];

                if (password_verify($stmt["password"], $hashed_password) && $this->getEmail() == $stmt['email']) {
                    return true;
                }
            }
        }
    }

    /**
     * registra o usuário no banco de dados
     * @param string name
     * @param string email
     * @param string password
     * 
     */
    public function registerUser($name, $email, $password)
    {
        $sql = 'INSERT INTO user (name, email, senha) VALUES (?, ?, ?)';

        $stmt = $this->connect->prepare($sql);
        var_dump($stmt);
        // Vincula variáveis ​​à instrução preparada como parâmetros
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $password);

        if ($stmt->execute()) {
            // Redireciona para a página de login
            header("location: login.html");
        } else {
            echo "Opa! Algo deu errado na transação do banco de dados. Tente novamente.";
        }

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

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}