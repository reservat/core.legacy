<?php

namespace Reservat\Test;

use \Reservat\Core\Config;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    protected $bar = null;

    public function setUp()
    {
        require_once(__DIR__.'/_files/bar.php');
    }

    public function testCreate()
    {
        $bar = \Reservat\Test\Bar::create([
            'name' => 'Paul Westerdale',
            'email' => 'paul@westerdale.me'
        ]);

        $this->assertEquals($bar->getName(), 'Paul Westerdale');
        $this->assertEquals($bar->getEmail(), 'paul@westerdale.me');
    }

    public function testInvalidArgument()
    {

        $this->setExpectedException('InvalidArgumentException');
        $bar = \Reservat\Test\Bar::create([
            'name' => 'Paul Westerdale',
            'email' => 'paul@westerdale.me',
            'shoesize' => 21
        ]);
        
    }
}
