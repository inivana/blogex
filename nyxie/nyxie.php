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
    private $protected_routes = [];
    private $default_endpoint_name = null;
    private $default_method = "index";

    function start()
    {
        if (!$this->default_endpoint_name) {
            throw new Exception("No default controller specified.");
        }

        $endpoint_name = null;
        $method_name = null;

        // Remove first slash to parse it easier
        $request_url = ltrim($_SERVER["REQUEST_URI"], "/");

        // Delete GET parameters from url if passed
        $get_params_start = strpos($request_url, "?");
        if ($get_params_start)
        {
            $request_url = substr($request_url, 0, strpos($request_url, "?"));
        }

        $path_info = !strlen($request_url) ? [] : explode("/", $request_url);

        // Ignore first route section if it exists as directory in previous directory
        if (count($path_info) > 0 && is_dir("../" . $path_info[0])) {
            array_shift($path_info);
        }

        switch (count($path_info)) {
            case 1:
                $endpoint_name = $path_info[0];
                $method_name = $this->default_method;
                break;
            case 2:
                $endpoint_name = $path_info[0];
                $method_name = $path_info[1];
                break;
            default:
                $endpoint_name = $this->default_endpoint_name;
                $method_name = $this->default_method;
                break;
        }

        // Auth
        if (array_key_exists($endpoint_name, $this->protected_routes)) {
            if ($this->protected_routes[$endpoint_name] == null || in_array($method_name, $this->protected_routes[$endpoint_name])) {
                if (!Session::exists()) {
                    header("Location: /auth");
                } else {
                    Session::regenerate();
                }
            }
        }

        $controller_class_name = $this->resolve_endpoint($endpoint_name);

        if (count($_GET)) {
            $method_name .= "_get";
        } elseif (count($_POST)) {
            $method_name .= "_post";
        }

        if (!method_exists($controller_class_name, $method_name)) {
            $method_name = $this->default_method;
        }

        if (isset($_GET["debug"])) {
            echo "Controller classname: " . $controller_class_name . "<br>";
            echo "Method name: " . $method_name . "<br>";
            if (Session::exists())
                echo "User logged as: " . Session::get_user_id() . "<br>";
            else
                echo "User not logged<br>";
            echo "GET variables<br>";
            echo "<pre>";
            var_dump($_GET);
            echo "</pre>";
            echo "POST variables<br>";
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
        }

        try {
            $controller = new $controller_class_name();
            $controller->$method_name();
        } catch (Exception $e) {
            throw new RuntimeException("Running controller method failed");
        }

        return true;
    }

    private function resolve_endpoint($endpoint_name)
    {
        if (array_key_exists($endpoint_name, $this->registered_controllers)) {
            return $this->registered_controllers[$endpoint_name];
        } else {
            return $this->registered_controllers[$this->default_endpoint_name];
        }
    }

    public function register_controller($endpoint_name, $controller_name, $is_default = false)
    {
        if (!method_exists($controller_name, $this->default_method)) {
            throw new Exception("Default method " . $this->default_method . " is not implemented in " . $controller_name);
        }
        if ($is_default && $this->default_endpoint_name) {
            throw new Exception("There can exists only one default controller. Current: " . $this->resolve_endpoint($this->default_endpoint_name) . "New: " . $controller_name);
        } elseif ($is_default) {
            $this->default_endpoint_name = $endpoint_name;
        }

        $this->registered_controllers[$endpoint_name] = $controller_name;
    }

    /*
     * Protect unauthorized users to access route.
     * if $methods_name == null then whole controller will be protected
     * otherwise there should be list of methods
     */
    public function protect_controller($endpoint_name, $methods_name = null)
    {
        $this->protected_routes[$endpoint_name] = $methods_name;
    }

    static function __autoload($class_name)
    {
        $class_name = strtolower($class_name);
        if (is_file(CLASSESPATH . $class_name . '.php'))
            require_once(CLASSESPATH . $class_name . '.php');

        if (is_file(CONTROLLERSPATH . $class_name . '.php'))
            require_once(CONTROLLERSPATH . $class_name . '.php');

        if (is_file(MODELSPATH . $class_name . '.php'))
            require_once(MODELSPATH . $class_name . '.php');
    }
}