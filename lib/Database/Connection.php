<?php


namespace App\Database;

use \PDO;

abstract class Connection
{
    protected $conexao;

    public function __construct()
    {
        $conn = "mysql:host=" . $_ENV['db']['host'] . ";dbname=" . $_ENV['db']['database'];

        $this->conexao = new PDO($conn, $_ENV['db']['user'], $_ENV['db']['pass']);
    }
}