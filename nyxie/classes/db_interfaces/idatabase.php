<?php

interface IDatabase
{
    function select($tables, $from);
    function where($tables, $from, $where);
    function insert($table, $values);
    function query($query);
}