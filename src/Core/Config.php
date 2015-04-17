<?php

namespace Reservat\Core;

class Config implements \ArrayAccess
{

    protected $config = [];

    public function __construct($path)
    {
        \Dotenv::load($path);
    }

    public function &__get($key)
    {
        $conf = isset($config[$key]) ? $config[$key] : getenv($key);
        return $conf;
    }

    public function __set($key, $value)
    {
        $this->config[$key] = $value;
    }

    public function __isset($key)
    {
        return isset($this->config[$key]);
    }

    public function __unset($key)
    {
        unset($this->config[$key]);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->config[$value] = null;
        } else {
            $this->config[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->config[$offset]);
        }
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->config[$offset] : null;
    }
}
