<?php

namespace Reservat\Test;

use \Reservat\Core\Config;
use \Reservat\Repository\BarRepository;
use Aura\Di\Container;
use Aura\Di\Factory;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    protected $bar = null;
    protected $di = null;

    public function setUp()
    {
        require_once(__DIR__.'/_files/bar.php');
        require_once(__DIR__.'/_files/BarRepository.php');

        $this->di = new Container(new Factory);
        $this->di->set('db', function () {
            return new \PDO('sqlite::memory:');
        });
    }

    public function testCreate()
    {
        $bar = \Reservat\Bar::createFromArray([
            'name' => 'Paul Westerdale',
            'email' => 'paul@westerdale.me'
        ], new BarRepository($this->di->get('db')));

        $this->assertEquals($bar->getName(), 'Paul Westerdale');
        $this->assertEquals($bar->getEmail(), 'paul@westerdale.me');
    }
}
