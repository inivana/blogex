<?php
class Session
{
	private	$config = array('COOKIE_NAME' => 'nyxie_cookie', 'COOKIE_EXPIRE' => 180),
			$db_handler,
			$id,
			$ip,
			$browser,
			$time;
			
	function __construct($db_handler)
	{	
		$this->db_handler = $db_handler;
	}
	
	function create_session($value)
	{
		if(!$this->is_session())
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			
			$session_name = sha1(uniqid(time() + $ip));
			$session_value = $value;
			$session_time = time() + $this->config['COOKIE_EXPIRE'];
			
			$create = $this->db_handler->insert('sessions', array($session_name, $session_value, $session_time));
			setCookie($this->config['COOKIE_NAME'], $session_name, $session_time);
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function regenerate_session()
	{
		$cookie_name = $_COOKIE[$this->config['COOKIE_NAME']];
		$session_time = time() + $this->config['COOKIE_EXPIRE'];
		
		setCookie($this->config['COOKIE_NAME'], $_COOKIE[$this->config['COOKIE_NAME']], $session_time);
		$this->db_handler->query('UPDATE `sessions` SET `session_time` = "' . $session_time . '" WHERE `session_name` = "' . $cookie_name . '"');
	}
	
	function is_session()
	{
		if(array_key_exists($this->config['COOKIE_NAME'], $_COOKIE))
			return true;
		else
			return false;
	}
	
	function destroy_session($session_name = null)
	{
		$cookie_name = $_COOKIE[$this->config['COOKIE_NAME']];
		
		if(array_key_exists($this->config['COOKIE_NAME'], $_COOKIE))
		{
			setCookie($this->config['COOKIE_NAME'], 'deleted', time()-5);
			
			if($session_name == null)
				$this->db_handler->query('DELETE FROM sessions WHERE session_name = "' . $cookie_name . '" LIMIT 1');
			else
				$this->db_handler->query('DELETE FROM sessions WHERE session_name = "' . $session_name . '" LIMIT 1' );
			
			return true;
		}
		else
			return false;
	}
	
	function garbage_collector()
	{
		$session = $this->db_handler->query(array('session_id', 'session_time'), 'sessions');
		while($row = $this->db_handler->fetch())
		{
			if($row['session_time']  < time())
			{
				$this->destroy_session($row['session_id']);
			}
		}
	}
}
?>