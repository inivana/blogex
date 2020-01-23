<?php
class ArticleController extends Nyxie{

	
	function index(){
		$view = new View();	
		$articledID = $_GET['id']; 
		$article_model = new ArticleModel();
		$article = $article_model->get_article($articledID);
		$view->assign("id",$article['Title']);
        $menu_links = [
            array("label" => "Main", "href" => ""),
            array("label" => "Admin Panel", "href" => "adminpanel"),
            array("label" => "Categories", "href" => ""),
            array("label" => "About", "href" => ""),
            array("label" => "Contact", "href" => ""),
        ];
		$post_model = new PostModel();
        $posts = $post_model->getAll($articledID);
        $permission = $post_model->display_post_field($articledID);
        $view->assign("menu_links", $menu_links);
		$view->assign("article",$article);
		$view->assign("posts",$posts);
		$view->assign("permission",$permission[0]["blocked"]);
        $view->display("blog/article.php");
	}
	
	function index_after_post($articledID){
		$view = new View();	
		$article_model = new ArticleModel();
		$post_model = new PostModel();
		$article = $article_model->get_article($articledID);
		$permission = $post_model->display_post_field($articledID);
		$view->assign("id",$article['Title']);
        $menu_links = [
            array("label" => "Main", "href" => ""),
            array("label" => "Admin Panel", "href" => "adminpanel"),
            array("label" => "Categories", "href" => ""),
            array("label" => "About", "href" => ""),
            array("label" => "Contact", "href" => ""),
        ];
		$post_model = new PostModel();
        $posts = $post_model->getAll($articledID);
        $view->assign("menu_links", $menu_links);
		$view->assign("permission",$permission[0]["blocked"]);
		$view->assign("article",$article);
		$view->assign("posts",$posts);
        $view->display("blog/article.php");
	}
	
	function posts_post(){
		$articleID = $_POST["id"];
		$content = $_POST["content"];
		$userID = Session::get_user_id();
		

		$post_model = new PostModel();
		$post_model->insert_post($articleID,$userID,$content);	
		$this->index_after_post($articleID);	
	}
}


?>