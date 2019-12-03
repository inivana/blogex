<?php 
class IndexController extends Nyxie
{
    function index()
    {
        $view = new View();
        $view->display("index.html");
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
	function nowy(){
	    $view = new View();
		$view->assign("title", "fds");
        $view->display("nowy.php");
	}
	function blogex(){
		$view = new View();
        $view->display("main-view.php");
	}
}