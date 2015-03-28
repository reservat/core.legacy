<?

namespace Reservat\Core;

class Config implements \ArrayAccess
{

	protected $_config = [];

	public function __construct()
    {
		$this->_config = require_once __DIR__ . '/../../config.php';
	}

    public function &__get ($key) 
    {
        return $this->_config[$key];
    }

    public function __set($key,$value) 
    {
        $this->_config[$key] = $value;
    }

    public function __isset ($key) 
    {
        return isset($this->_config[$key]);
    }

    public function __unset($key) 
    {
        unset($this->_config[$key]);
    }

    public function offsetSet($offset,$value) 
    {
        if(is_null($offset))
        {
            $this->_config[] = $value;
        } else {
            $this->_config[$offset] = $value;
        }
    }

    public function offsetExists($offset) 
    {
        return isset($this->_config[$offset]);
    }

    public function offsetUnset($offset) 
    {
        if($this->offsetExists($offset)) 
        {
            unset($this->_config[$offset]);
        }
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->_config[$offset] : null;
    }

}