<?php

namespace Lib\Database;

use PDO;

/**
 * Classe de usuário usando Data Access Object
 * para pegar informações do usuário no banco.
 */
class UserDao extends Connection
{
    /**
     * Método para pegar informações do usuário 
     * a partir de um id
     * @param string id
     * @return object row
     */
    public function getUserById($id)
    {
        $sql = 'SELECT * FROM public.user WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);

        // Vincula a variável ​​à instrução preparada como parâmetros
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Checa se o usuário existe, se sim retorna um objeto.
            if ($stmt->rowCount() == 1) {
                if($row = $stmt->fetchObject('App\Model\User')) {
                    return $row;
                } else {
                    // Caso contrário, retorna um erro.
                    echo "Usuário não encontrado.";
                    return null;
                }
            }
        }
    }
}