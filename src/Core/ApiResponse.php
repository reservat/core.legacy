<?

namespace Reservat\Core;

abstract class ApiResponse
{

	protected $_data = [];
	protected $_code = 200;

	public function __construct($data, $code = false)
	{
		$this->_data = $data;
		if($code){
			$this->_code = $code;
		}
	}

	public function getCode()
	{
		return $this->_code;
	}

	public function getData()
	{
		return $this->_data;
	}

	public function serve($res)
	{
		$res->code($this->getCode());
		$res->json($this->buildBody());
		$res->send();
	}

	public static function build($data, $code = false)
	{
		return new static($data, $code);
	}

}