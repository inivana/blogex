<?php
ob_start();
if (!defined('CLASSESPATH'))
    define('CLASSESPATH', NYXIEPATH . 'classes/');

if (!defined('APPSPATH'))
    define('APPSPATH', NYXIEPATH . 'apps/');

if (!defined('CONTROLLERSPATH'))
    define('CONTROLLERSPATH', APPSPATH . 'controllers/');

if (!defined('VIEWSPATH'))
    define('VIEWSPATH', APPSPATH . 'views/');

if (!defined('MODELSPATH'))
    define('MODELSPATH', APPSPATH . 'models/');

spl_autoload_register(array('Nyxie', '__autoload'));

class Nyxie
{
    private $registered_controllers = [];
    private $default_controller;
    private $default_method = "index";

    function start()
    {
        $controller_name = null;
        $method_name = null;

        // Remove first slash to parse it easier
        $request_url = ltrim($_SERVER["REQUEST_URI"], "/");
        $path_info = !strlen($request_url) ? [] : explode("/", $request_url);
        switch (count($path_info)) {
            case 0:
                $controller_name = $this->default_controller;
                $method_name = $this->default_method;
                break;
            case 1:
                $controller_name = $path_info[0] . "Controller";
                $method_name = $this->default_method;
                break;
            case 2:
                $controller_name = $path_info[0] . "Controller";
                $method_name = $path_info[1];
                break;
        }

        try
        {
            $controller = new $controller_name();
            $controller->$method_name();
        }
        catch (Exception $e) {
            echo "Site does not exists!";
        }

        return true;
    }

    function register_controller($endpoint_name, $controller_name, $is_default = false)
    {
        // TODO: Allow to register only one controller as default
        // TODO: Follow registered endpoints to evaluate which controller should be loaded
        if ($is_default) {
            $this->default_controller = $controller_name;
        }

        $this->registered_controllers[$endpoint_name] = $controller_name;
    }

    static function __autoload($class_name)
    {
        $class_name = strtolower($class_name);
        if (is_file(CLASSESPATH . $class_name . '.php'))
            require_once(CLASSESPATH . $class_name . '.php');

        if (is_file(CONTROLLERSPATH . $class_name . '.php'))
            require_once(CONTROLLERSPATH . $class_name . '.php');
    }
}