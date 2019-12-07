<?php
require_once("interface.php");
// TODO: Determine if $tables is list or just a string
class Mysql implements IDatabase
{
	public $connection;
	public $results;
	
	function connect($host, $user, $pass)
	{
		$this->connection = mysql_connect($host, $user, $pass);
		mysql_select_db("blogex", $this->connection);
		
		return true;
	}
	
	function select($tables, $from)
	{
	    $results = [];
		$resource = $this->query("SELECT " . implode(",", $tables) . " FROM " . $from);
		while($row = mysql_fetch_assoc($resource))
        {
            array_push($results, $row);
        }
		
		return $results;
	}
	
	function where($tables, $from, $where)
	{
		$results = $this->query("SELECT " . implode(",", $tables) . " FROM " . $from . " WHERE " . $where);
	}
	
	function insert($table, $values)
	{
		$values = implode(",", $this->add_apostrophe($values));
		
		$this->query("INSERT INTO " . $table . " VALUES (" . $values . ")");
		
		return true;
	}
	
	function query($query)
	{
		return mysql_query($query, $this->connection);
	}
	
	function fetch()
	{
		$results = mysql_fetch_assoc($this->results);
		
		return $results;
	}
	
	function num_rows()
	{
		$num_rows = mysql_num_rows($this->results);
		
		return $num_rows;
	}

	function add_apostrophe($array)
	{
		$new_array = null;
		
		for($i = 0; $i <= count($array)-1; $i++)
		{
			$new_array[$i] = "\"" . $array[$i] . "\"";
		}
		
		return $new_array;
	}
	
	function __destruct()
	{
		mysql_close($this->connection);
	}
}