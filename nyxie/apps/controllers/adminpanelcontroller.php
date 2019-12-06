<?php

class AdminPanelController extends Nyxie
{
    function index()
    {
        $view = new View();
        $view->display("main-view.php");
    }
	
	function get_index(){
		
	}

    function checkmore()
    {
        $array = ["Item 1", "Item 2", "Item 3"];
        $view = new View();
        $view->assign("title", "Lista");
        $view->assign("items", $array);
        $view->display("checkmore.php");
    }
	function add_article()
    {
        $array = ["Item 1", "Item 2", "Item 3"];
        $view = new View();
        $view->assign("title", "Add article");
        $view->assign("items", $array);
        $view->display("add-article.php");
    }
	function blogex(){
		$view = new View();
        $view->display("main-view.php");
	}
	function mode(){
		$view = new View();
		$title = "hello";
		$view->assign("title",$title);
        $view->display("mode.php");
	}
	function settings(){
		$view = new View();
        $view->display("settings.php");
	}
	 
}