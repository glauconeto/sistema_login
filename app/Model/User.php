<?php

namespace App\Model;

use App\Database\Connection;
use PDO;

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

        // Vincula as variáveis ​​à instrução preparada como parâmetros
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

    public function registerUser($name, $email, $password)
    {
        $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';

        if ($stmt = $this->connect->prepare($sql)) {
            // Vincula variáveis ​​à instrução preparada como parâmetros
            $stmt->bindValue(1, $name, PDO::PARAM_STR);
            $stmt->bindValue(2, $email, PDO::PARAM_STR);
            $stmt->bindValue(3, $password, PDO::PARAM_STR);

            $prep_pass = password_hash($password, PASSWORD_DEFAULT);

            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
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
        $this->password = $password;
    }
}