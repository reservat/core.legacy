<?php

use \Reservat\Core\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    protected $config = null;

    public function setUp()
    {
        if(!$this->config instanceof Config) {
            $this->config = new Config(__DIR__ . '/_files/');
        }

        return $this->config;
    }

    public function testLoaded()
    {
        $this->assertInstanceOf('\Reservat\Core\Config', $this->config);
        $this->assertArrayHasKey('mysql', $this->config);
    }

    public function testGetConfigValues()
    {
        $this->assertEquals('bar.host', $this->config['mysql']['host']);
        $this->assertEquals('foo', $this->config['mysql']['user']);
        $this->assertEquals('baz', $this->config['custom']['bar']);
    }

    public function testSetConfigValues()
    {
        $this->config->luke = 'steadman';
        $this->config['paul'] = 'westerdale';
        $this->config[] = 'kieron';
        $this->config['kieron'] = 'yorke';

        $this->assertEquals('steadman', $this->config->luke);
        $this->assertEquals('steadman', $this->config['luke']);
        $this->assertEquals('westerdale', $this->config->paul);
        $this->assertEquals('westerdale', $this->config['paul']);
        $this->assertEquals('yorke', $this->config->kieron);
        $this->assertEquals('yorke', $this->config->kieron);
    }

    public function testUnsetConfigValues()
    {
        $this->config->pete = 'fritchly';
        $this->config->kieron = 'yorke';

        unset($this->config['pete']);
        unset($this->config->kieron);

        $this->assertFalse(isset($this->config->pete));
        $this->assertFalse(isset($this->config['kieron']));
    }

    public function testConfigExists()
    {
        $this->assertNotFalse(isset($this->config->mysql));
        $this->assertNotFalse(isset($this->config['mysql']));
    }

    public function testNotsetConfigValues()
    {
        $this->assertFalse(isset($this->config->kieron));
        $this->assertFalse(isset($this->config['kieron']));
    }

    public function testConfigCount()
    {
        $this->assertCount(1, $this->config->custom);
    }

    public function testNull()
    {
        $this->assertNull($this->config->nothing);
    }

    public function testDotEnvWithConfig()
    {
        Dotenv::load(__DIR__ . '/_files/');
        $config = new  Config(__DIR__ . '/_files/', 'dotenv.php');

        $this->assertEquals(getenv('MYSQL_USER'), $config->mysql['user']);
        $this->assertEquals(getenv('MYSQL_HOST'), $config->mysql['host']);
        $this->assertEquals(getenv('CUSTOM_BAR'), $config->custom['bar']);
    }
}