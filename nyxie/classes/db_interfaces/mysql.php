<?php
require_once("idatabase.php");

class MySQL implements IDatabase
{
    protected $connection;

    public function connect($host, $user, $pass, $db_name)
    {
        $this->connection = new mysqli($host, $user, $pass, $db_name);
        if (!$this->connection) {
            throw new Exception("Cannot connect to MySQL DB");
        }

        $this->connection->autocommit(true);
    }

    function select($tables, $from)
    {
        if (is_string($tables))
            $tables = [$tables];

        return $this->query("SELECT " . implode(",", $tables) . " FROM " . $from);
    }

    function where($tables, $from, $where)
    {
        if (is_string($tables))
            $tables = [$tables];

        return $this->query("SELECT " . implode(",", $tables) . " FROM " . $from . " WHERE " . $where);
    }

    function insert($table, $values)
    {
        $keys_string = implode(",", array_keys($values));
        $values_string = implode(",", array_map([$this, "add_quotes"], array_values($values)));

        return $this->query("INSERT INTO " . $table . "(" . $keys_string . ") VALUES (" . $values_string . ")");
    }

    function query($query)
    {
        $query_result = $this->connection->query($query);
        $return_result = null;

        if (is_bool($query_result)) {
            $return_result = $query_result;
        } else {
            $return_result = $this->fetch_all($query_result);
            $query_result->close();
        }
        return $return_result;
    }

    private function add_quotes($value)
    {
        return "\"" . $value . "\"";
    }

    private function fetch_all($query_result)
    {
        for ($res = array(); $tmp = $query_result->fetch_array(MYSQLI_ASSOC);) $res[] = $tmp;
        return $res;
    }

    public function __destruct()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}