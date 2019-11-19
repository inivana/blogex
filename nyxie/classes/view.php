<?php
class View
{
	public $view_file;
	public $view_vars = array();
		
	function assign($name, $value)
	{
	    $this->view_vars = array_merge($this->view_vars, [$name => $value]);
	}
	
	function display($file)
	{
		extract($this->view_vars);
		include(VIEWSPATH . $file);
	}
}