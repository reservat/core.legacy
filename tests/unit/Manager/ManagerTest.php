<?php

namespace Reservat\Test;

use \Reservat\Manager\FooManager;
use \Reservat\Repository\FooRepository;
use \Reservat\Datamapper\FooDatamapper;
use \Reservat\Foo;

use Aura\Di\Container;
use Aura\Di\Factory;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $di = null;

    public function setUp()
    {
        require_once(__DIR__.'/_files/FooManager.php');
        require_once(__DIR__.'/_files/Foo.php');
        require_once(__DIR__.'/_files/FooRepository.php');
        require_once(__DIR__.'/_files/FooDatamapper.php');

        $this->di = new Container(new Factory);

        $schema =<<<SQL
        CREATE TABLE "foo" (
        "id" INTEGER PRIMARY KEY,
        "name" VARCHAR NOT NULL,
        "email" VARCHAR NOT NULL
        );
SQL;

        $this->di->set('db', function () {
            return new \PDO('sqlite::memory:');
        });

        $this->di->get('db')->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->di->get('db')->exec($schema);
    }

    public function testCreateEntity()
    {
        $fooManager = new FooManager($this->di);

        $foo = $fooManager->getEntity('Paul', 'paul@westerdale.me');

        $this->assertInstanceOf('Reservat\\Foo', $foo);
        $this->assertEquals($foo->getEmail(), 'paul@westerdale.me');
        $this->assertEquals($foo->getName(), 'Paul');
    }

    public function testSaveEntity()
    {
        $fooManager = new FooManager($this->di);

        $foo = $fooManager->getEntity('Luke', 'luke@steadw.eb');
        $fooManager->getDatamapper()->insert($foo);
        
        unset($foo);

        $foo = $fooManager->getRepository()->getById(1)->getResults();

        $foo = \Reservat\Foo::createFromArray($foo);

        $this->assertInstanceOf('Reservat\\Foo', $foo);
        $this->assertEquals($foo->getEmail(), 'luke@steadw.eb');
        $this->assertEquals($foo->getName(), 'Luke');
    }
}
