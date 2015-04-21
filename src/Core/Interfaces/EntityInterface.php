<?php

namespace Reservat\Core\Interfaces;

interface EntityInterface
{
    public function toArray();
    public static function createFromArray(array $data);
}
