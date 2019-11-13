<?php
class Database
{
	static function set_type($interface)
	{
		require_once('db_interfaces/' . $interface . '.php');
		return new $interface();
	}
}