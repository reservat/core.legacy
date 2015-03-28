<?

namespace Reservat\Core;

use Reservat\Core\Config;
use Monolog\Logger;
use Monolog\Handler\SlackHandler;

class Log
{

	protected static $_instance = null;
	protected static $_log = null;

	public function __construct()
	{
		$config = new Config();
		$config = $config->log['slack'];

		// TODO: maybe add file logging for lower errors

		static::$_log = new Logger('slack');
		static::$_log->pushHandler(new SlackHandler(
			$config['token'], 
			$config['channel'], 
			$config['username'], 
			true, 
			$config['emote'], 
			Logger::ERROR
		));
	}

	public static function log($func, $args)
	{
		if(static::$_instance === null)
		{
			static::$_instance = new static();
		}
		static::$_log->$func($args);
	}

	public static function __callstatic($func, $args)
	{
		static::log($func, implode($args));
	}

}