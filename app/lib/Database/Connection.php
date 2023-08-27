<?php


namespace Lib\Database;

use PDO;
use PDOException;

/**
 * Classe de conexão com o banco de dados
 */
class Connection 
{
    protected $conn;
    protected $pdo;
    private $host = '127.0.0.1';
    private $user = 'neto';
    private $password = 'netozicadb';
    private $database = 'sistema_login';

    public function __construct()
    {
        try {
            $conn = "pgsql:host=" . $this->host . ';port=5432' . ";dbname=" . $this->database;

            $this->pdo = new PDO($conn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}