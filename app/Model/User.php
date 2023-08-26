<?php

namespace App\Model;

use App\Database\Connection;

class User extends Connection
{
    private $name;
    private $email;
    private $password;

    public function __construct()
    {
        Connection::class;
    }


    public function getUser($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email=? AND password=?';
        $stmt = $this->connect->prepare($sql);

        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $password);
        $stmt->execute();

        if ($stmt->rowCount()) {
            if ($stmt->fetch()) {
                $hashed_password = $stmt["password"];

                if (password_verify($stmt["password"], $hashed_password) && $this->getEmail() == $stmt['email']) {
                    $_SESSION['userIn'] = true;
                }
            }
        }
    }

    public function registerUser($email, $password)
    {

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
        $this->password = $password;
    }
}