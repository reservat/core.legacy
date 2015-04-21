<?php

namespace Reservat\Core;

abstract class Entity
{

    private $id = null;

    public function setId($id)
    {
        if (!$this->id) {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return $this->id;
    }
}
