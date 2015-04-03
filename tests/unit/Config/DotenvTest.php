<?php

class DotenvTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        Dotenv::load(__DIR__ . '/_files/');
    }

    public function testDotEnvLoaded()
    {
        $this->assertEquals('foo', getenv('MYSQL_HOST'));
        $this->assertEquals('bar', getenv('MYSQL_USER'));
        $this->assertEquals('baz', getenv('CUSTOM_BAR'));
    }

    public function testDotEnvInvalid()
    {
        $this->assertFalse(getenv('INCORRECT_CONFIG'));
    }
}