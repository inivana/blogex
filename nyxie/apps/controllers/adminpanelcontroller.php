﻿<?php

class AdminPanelController extends Nyxie
{
    function index()
    {
        $view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->display("mode.php");
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
	function add_article_post()
    {
		//INSERT INTO `users`( `LastName`, `Password`, `FirstName`, `Email`, `Premium`) VALUES ("Pudzian","123","Mirek","awesomebug15230@gmail.com",false) 
		//INSERT INTO `categories`(`Category`) VALUES ('Sport')
		//INSERT INTO `categories`(`Category`) VALUES ('Drugs')
		//INSERT INTO `categories`(`Category`) VALUES ('Women in your area')
		//INSERT INTO `articles`(`Title`, `Content`, `Date`, `UserID`, `CategoryID`) VALUES ('Nowy rok','Gralem w gre. -Jaką? - Tomb Rider. - Dziekuje.','2019-12-31',1,1)

		$content = $_POST['content'];
		$title = $_POST['title'];
		$categoryID = "1";
		$userID = "1";

        $view = new View();
		$article_model = new ArticleModel();
		$article_model->insert_article($userID,$content,$title,$categoryID);
		$view->assign("menu_bar", "left-menu.php");
        $view->display("mode.php");
    }
	function mode(){
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
		$title = "hello";
		$view->assign("title",$title);
        $view->display("mode.php");
	}
	function mode_get(){
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
		$title = $_GET['title'];
        $view->assign("title", $title);
        $view->display("mode.php");
	}
	function settings(){
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->display("settings.php");
	}
	 
}