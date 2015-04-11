<?php

namespace Reservat;

class Bar extends \Reservat\Core\Entity
{
    protected $name = null;
    protected $email = null;
    protected $woodChucks = null;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getWoodChucks()
    {
        return $this->woodChucks;
    }
}
