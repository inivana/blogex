<?php
class View
{
	public $view_file;
	public $view_vars = array();
		
	function assign($vars)
	{
		if(!is_null($vars))
			$this->view_vars = array_merge($this->view_vars, $vars);
	}
	
	function display($file)
	{
		extract($this->view_vars);
		include(VIEWSPATH . $file);
	}
}