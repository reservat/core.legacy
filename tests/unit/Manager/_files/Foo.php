<?php

namespace Reservat;

use Reservat\Core\Interfaces\EntityInterface;
use Reservat\Core\Entity;

class Foo extends Entity implements EntityInterface
{
    protected $name = null;
    protected $email = null;

    public function __construct(...$args)
    {
        $this->name = isset($args[0]) ? $args[0] : null;
        $this->email = isset($args[1]) ? $args[1] : null;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
