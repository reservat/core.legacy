<?php

namespace Reservat\Test;

class Bar extends \Reservat\Core\Entity
{
    protected $name = null;
    protected $email = null;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
