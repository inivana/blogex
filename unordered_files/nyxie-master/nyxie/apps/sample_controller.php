<?php 
class Controller extends Nyxie
{
	function __construct()
	{
		$this->database = Database::set_type('mysql');
		$this->database->connect('localhost', 'root', '11913781');
		$this->session = new Session($this->database);
	}
	
	function index()
	{
		foreach($_SERVER as $key => $value)
		{
			echo $key . ' => ' . $value . '<br />';
		}
	}
	
	function create()
	{
		if($this->session->create_session('mieczyslaw'))
			echo 'Cookie utworzone ! Kliknij <a href="http://localhost/' . $_SERVER['SCRIPT_NAME'] . '/destroy">tutaj</a> by je usunąć.';
		else
			echo 'Sesja jest już utworzona ! Kliknij <a href="http://localhost/' . $_SERVER['SCRIPT_NAME'] . '/destroy">tutaj</a> by ja usunąć.';
	}
	
	function destroy()
	{
		echo @$this->session->destroy_session() ? 'Sesja została usunięta !' : 'Sesja nie istnieje na Twoim komputerze !';		
	}
}