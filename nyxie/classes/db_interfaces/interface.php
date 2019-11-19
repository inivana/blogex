<?php
interface IDatabase
{
	/*
	 * Nie może w interfejsie istniec ta funkcja przez różną liczbę parametrów potrzebnych do połączenia
	 * z bazą. Np. MySQL i SQLite
	 * 
	 */
	// function connect();

	function select($tables, $from);
	
	function where($tables, $from, $where);
	
	function insert($table, $values);

	function query($query);
	
	function fetch();
	
	function num_rows();
	/*
	 * Połączenie jest zamykane przy usuwaniu klasy
	 */
	function __destruct();
}