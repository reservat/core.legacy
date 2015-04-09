<?php

namespace Reservat\Core;

abstract class Entity
{

    public static function create($data)
    {
        $entity = new static();

        foreach ($data as $key => $value) {
            if (property_exists($entity, $key)) {
                $entity->$key = $value;
            } else {
                throw new \InvalidArgumentException('Property ' . $key . ' does not exist on Entity ' . get_class($entity));
            }
        }

        return $entity;

    }
}
