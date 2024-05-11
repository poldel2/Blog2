<?php

namespace Laravel\Blog\application\models;

class User
{
    private $id;
    private $name;
    private $email;

    private $password;

    public function __construct(?int $id, private string $username, private string $_email, private string $_password)
    {
        if ($id) {
            $this->id = $id;
        }
        $this->name = $this->username;
        $this->email = $this->_email;
        $this->password = $this->_password;
    }

    public function getUsername(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }


}