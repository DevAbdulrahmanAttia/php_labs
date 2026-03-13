<?php

namespace Models;

class Employee
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $address;
    public string $username;
    public string $image;

    public function __construct(
        int    $id        = 0,
        string $firstName = '',
        string $lastName  = '',
        string $email     = '',
        string $address   = '',
        string $username  = '',
        string $image     = ''
    ) {
        $this->id        = $id;
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->email     = $email;
        $this->address   = $address;
        $this->username  = $username;
        $this->image     = $image;
    }
}
