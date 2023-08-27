<?php

namespace Lib\Database;

use PDO;

class LoginDao extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectUser($email, $password)
    {
        $sql = 'SELECT * FROM public.user WHERE email=:email';
        $stmt = $this->pdo->prepare($sql);

        // Vincula as variáveis ​​à instrução preparada como parâmetros
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            // Check if username exists, if yes then verify password
            if ($stmt->rowCount() == 1) {
                if($row = $stmt->fetch()) {
                    $hashed_password = $row['password'];
                    
                    if (password_verify($password, $hashed_password)) {

                        return $row;
                    } else {
                        // Password is not valid, display a generic error message
                        echo "Invalid username or password.";
                    }
                }
            }
        }
    }

    public function insertUser($name, $email, $password)
    {
        $sql = "INSERT INTO public.user (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($sql);

        // Vincula variáveis ​​à instrução preparada como parâmetros
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Opa! Algo deu errado na transação do banco de dados. Tente novamente.";
            return false;
        }
    }
}