<?php

namespace Reservat\Manager;

use Reservat\Core\Interfaces\ManagerInterface;
use Reservat\Repository\FooRepository;
use Reservat\Datamapper\FooDatamapper;
use Reservat\Foo;

class FooManager implements ManagerInterface
{
    public function __construct($di)
    {
        $this->repository = new FooRepository($di->get('db'));
        $this->datamapper = new FooDatamapper($di->get('db'));
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getDatamapper()
    {
        return $this->datamapper;
    }

    public function getEntity(...$args)
    {
        return new Foo(...$args);
    }
}
