<?php

namespace Reservat\Repository;

use Reservat\Core\Repository\PDORepository;

class FooRepository extends PDORepository
{
    public function table()
    {
        return 'foo';
    }
}
