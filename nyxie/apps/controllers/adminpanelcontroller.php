<?php

class AdminPanelController extends Nyxie
{
    function index()
    {
        $view = new View();
        $view->display("main-view.php");
    }

    function add_article()
    {
        $array = ["Item 1", "Item 2", "Item 3"];
        $view = new View();
        $view->assign("title", "Add article");
        $view->assign("items", $array);
        $view->display("add-article.php");
    }

    function mode()
    {
        $view = new View();
        $view->display("mode.php");
    }
}