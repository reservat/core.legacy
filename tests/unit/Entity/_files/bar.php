<?php

namespace Reservat;

class Bar extends \Reservat\Core\Entity implements \Reservat\Core\Interfaces\EntityInterface
{
    protected $name = null;
    protected $email = null;
    protected $woodChucks = null;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

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

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'woodchucks' => $this->woodChucks
        ];
    }

    public static function createFromArray(array $data)
    {
        return new static($data['name'], $data['email']);
    }
}
