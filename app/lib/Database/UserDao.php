<?php

namespace Lib\Database;

use PDO;

class UserDao extends Connection
{
    private $id;
    private $name;
    private $email;

    public function getUserById($id)
    {
        $sql = 'SELECT * FROM public.user WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);

        // Vincula as variáveis ​​à instrução preparada como parâmetros
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Check if username exists, if yes then verify password
            if ($stmt->rowCount() == 1) {
                if($row = $stmt->fetchObject('App\Model\User')) {
                    return $row;
                } else {
                    echo "Usuário não encontrado.";
                    return null;
                }
            }
        }
    }
}