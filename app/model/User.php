<?php

namespace App\Model;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function validateLogin()
    {
        // conectar no banco de dados
        // selecionar o usuário que tenha o mesmo email do informado
        // conferir a senha do usuário
        // se estiver tudo ok... crar session e direcionar pra tela dashboard
        // se tive algum erro... redirecionar de volta para a tela inicial
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getName($name)
    {
        return $this->name;
    }

    public function getEmail($email)
    {
        return $this->email;
    }

    public function getPassword($password)
    {
        return $this->password;
    }
}