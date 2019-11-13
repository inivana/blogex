<?php
ob_start();
if(!defined('CLASSESPATH'))
    define('CLASSESPATH', NYXIEPATH . 'classes/');

if(!defined('APPSPATH'))
    define('APPSPATH', NYXIEPATH . 'apps/');

if(!defined('CONTROLLERSPATH'))
    define('CONTROLLERSPATH', APPSPATH . 'controllers/');

if(!defined('VIEWSPATH'))
    define('VIEWSPATH', APPSPATH . 'views/');

if(!defined('MODELSPATH'))
    define('MODELSPATH', APPSPATH . 'models/');

spl_autoload_register(array('Nyxie', '__autoload'));

class Nyxie
{
	protected $controller = 'zapomnialem';
	protected $method;
	protected $param;
	
	function start()
	{
		$path_info = !array_key_exists('PATH_INFO', $_SERVER) ? 'index' : $_SERVER['PATH_INFO'];
		$path_info = explode('/', $path_info);
		$this->method = $path_info[1];
				
		$controller = $this->controller;
		$controller = new $controller();
		
		$method = $this->method;
		$controller->$method();
		
		return true;
	}

	static function __autoload($class_name)
	{
		if(is_file(CLASSESPATH . $class_name . '.php'))
			require_once(CLASSESPATH . $class_name . '.php');
			
		if(is_file(CONTROLLERSPATH . $class_name . '.php'))
			require_once(CONTROLLERSPATH . $class_name . '.php');
	}
}