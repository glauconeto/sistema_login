<?php

namespace Lib\Database;

use PDO;
use PDOException;

/**
 * Classe de conexão com o banco de dados
 */
abstract class Connection
{
    protected $connect;

    public function __construct()
    {
        try {
            $conn = "pgsql:host=" . $_ENV['db']['host'] . 'post=5432;' . ";dbname=" . $_ENV['db']['database'];
    
            $this->connect = new PDO($conn, $_ENV['db']['user'], $_ENV['db']['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}