<?php

namespace App\Model;

use App\Database\Connection;

class User
{
    private $id;
    private $name;
    private $password;
    private $created_at;
    private $table = 'user';

    public function __construct()
    {
        Connection::class;
    }

    public function getUser()
    {
        
    }
}