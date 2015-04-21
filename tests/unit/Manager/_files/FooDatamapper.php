<?php

namespace Reservat\Datamapper;

use Reservat\Core\Datamapper\PDODatamapper;

class FooDatamapper extends PDODatamapper
{
    public function table()
    {
        return 'foo';
    }
}
