<?php

class AdminPanelController extends Nyxie
{
    function index()
    {
        $view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->display("main-view.php");
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
		$view->assign("menu_bar", "left-menu.php");
        $view->assign("title", "Add article");
        $view->assign("items", $array);
        $view->display("add-article.php");
    }
	function index_get(){
        $view = new View();
		$title = $_GET['title'];
        $view->assign("title", $title);
        $view->display("main-view.php");
	}
	function mode(){
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
		$title = "hello";
		$view->assign("title",$title);
        $view->display("mode.php");
	}
	function settings(){
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->display("settings.php");
	}
	 
}