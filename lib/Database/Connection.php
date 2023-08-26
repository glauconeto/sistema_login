<?php


namespace App\Database;

use PDO;
use PDOException;

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