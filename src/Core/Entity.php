<?php

namespace Reservat\Core;

abstract class Entity
{

    private $id = null;

    public static function create($data)
    {
        $entity = new static();
        $repo = 'Reservat\Repository\\' . (new \ReflectionClass($entity))->getShortName() . 'Repository';

        foreach ($data as $key => $value) {
            $isFillable = in_array($key, array_keys($repo::$fillable));
            if (property_exists($entity, $key) || $isFillable) {
                if ($isFillable) {
                    $fillableKey = $repo::$fillable[$key];
                    $entity->$fillableKey = $value;
                } else {
                    $entity->$key = $value;
                }
            } else {
                throw new \InvalidArgumentException('Property ' . $key . ' does not exist on Entity ' . get_class($entity));
            }
        }
        return $entity;

    }
}
