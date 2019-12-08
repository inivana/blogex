<?php

class AdminPanelController extends Nyxie
{
    function index()
    {
		$article_model = new ArticleModel();
        $articles = $article_model->get_all();
		
        for($i = 0; $i < count($articles); $i++)
        {
            $articles[$i]["Content"] = substr($articles[$i]["Content"], 0, 350) . "...";
        }
		
		
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->assign("content_file", "mode-articles\mode-article-container.php");
		
		
        $view->assign("articles", $articles);
        $view->display("mode.php");
    }
	
	function mode_get(){
		$article_model = new ArticleModel();
		$var;//article ID
		foreach ($_GET as $key => $value) { 
		 $var = $value;
		}
		$articleDB  = $article_model->get_article($var);
		$tagsDB  = $article_model->get_article_tags($var);
		//tag field
		$tags_field = "";
		foreach ($tagsDB as $tag) { 
		 $tags_field = $tags_field . " #" . $tag['Tag'];
		}
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
		$view->assign("content", $articleDB['Content']);
		$view->assign("id",$var);
		$view->assign("title",$articleDB['Title']);
		$view->assign("tags", $tags_field);
        //$view->assign("articles", $articles);
        $view->display("edit-article.php");
	}
	
	
	function edit_article_post(){
		$content = $_POST['content'];
		$title = $_POST['title'];
		$id = $_POST['id'];
		$categoryID = "1";
		$tags = $_POST['tags'];
        $view = new View();
		$article_model = new ArticleModel();
		$article_model->update_article($id,$content,$title,$categoryID,$tags);		
		$this->index();
	}
	
	
	function delete_article_post(){
		$id = $_POST['id'];
		$article_model = new ArticleModel();
		$article_model->delete_article($id);	
		$this->index();
	}
	

	function add_article()
    {
        $view = new View();
		$view->assign("menu_bar", "left-menu.php");
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
		$tags = $_POST['tags'];
        $view = new View();
		$article_model = new ArticleModel();
		$article_model->insert_article($userID,$content,$title,$categoryID,$tags);
		
		$view->assign("menu_bar", "left-menu.php");
        $view->display("add-article.php");
    }


	function settings(){
		$view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->display("settings.php");
	}
	 
}