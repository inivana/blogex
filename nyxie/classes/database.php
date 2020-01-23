<?php

class Database
{
    private static $database_instance;
    static function set_type($interface)
    {
        try {
            require_once('db_interfaces/' . $interface . '.php');
        } catch (Exception $e) {
            throw new Exception("Cannot load DB interface");
        }
        Database::$database_instance = new $interface();
        Database::$database_instance->connect("localhost", "2019_s6", "pass", "2019_s6");
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([Database::$database_instance, $name], $arguments);
    }
}