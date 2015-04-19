<?php

namespace Reservat\Test;

use \Reservat\Core\Config;
use \Reservat\Repository\BarRepository;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    protected $bar = null;

    public function setUp()
    {
        require_once(__DIR__.'/_files/bar.php');
        require_once(__DIR__.'/_files/BarRepository.php');
    }

    public function testCreate()
    {
        $bar = \Reservat\Bar::create([
            'name' => 'Paul Westerdale',
            'email' => 'paul@westerdale.me'
        ], new BarRepository());

        $this->assertEquals($bar->getName(), 'Paul Westerdale');
        $this->assertEquals($bar->getEmail(), 'paul@westerdale.me');
    }

    public function testInvalidArgument()
    {

        $this->setExpectedException('InvalidArgumentException');
        $bar = \Reservat\Bar::create([
            'name' => 'Paul Westerdale',
            'email' => 'paul@westerdale.me',
            'shoesize' => 21
        ], new BarRepository());
        
    }
}
