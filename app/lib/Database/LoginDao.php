<?php

namespace Lib\Database;

use PDO;

/**
 * Classe de Login utilizando Data Acces Object para
 * realizar operações do sistema com o banco de dados.
 */
class LoginDao extends Connection
{
    /**
     * Método construtor que irá abrir uma conexão
     * com o banco.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método de seleção de usuário no banco, 
     * @param string email
     * @param string password
     * @return object row
     */
    public function selectUser($email, $password)
    {
        $sql = 'SELECT * FROM public.user WHERE email=:email';
        $stmt = $this->pdo->prepare($sql);

        // Vincula a variável ​​à instrução preparada como parâmetros
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            // Checa se o e-mail existe, se sim então verifica a senha.
            if ($stmt->rowCount() == 1) {
                if($row = $stmt->fetch()) {
                    $hashed_password = $row['password'];

                    if (password_verify($password, $hashed_password)) {
                        return $row;
                    } else {
                        // Se não é válida, então retorna uma mensagem de erro.
                        echo "E-mail ou senha inválidos.";
                    }
                }
            }
        }
    }

    /**
     * Método de inserir usuário no banco.
     * @param string name
     * @param string email
     * @param string password
     * @return boolean 
     */
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