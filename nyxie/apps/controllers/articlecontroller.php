<?php
class ArticleController extends Nyxie{

	
	function index(){
		$view = new View();	
		$id = $_GET['id'];
		$article_model = new ArticleModel();
		$article = $article_model->get_article($id);
		$view->assign("id",$article['Title']);
        $menu_links = [
            array("label" => "Main", "href" => ""),
            array("label" => "Admin Panel", "href" => "/adminpanel"),
            array("label" => "Categories", "href" => ""),
            array("label" => "About", "href" => ""),
            array("label" => "Contact", "href" => ""),
        ];
		$post_model = new PostModel();
        $posts = $post_model->getAll($id);
        $view->assign("menu_links", $menu_links);
		$view->assign("article",$article);
		$view->assign("posts",$posts);
        $view->display("blog/article.php");
	}
	
	function index_after_post($cachedID){
		$view = new View();	
		$id = $cachedID;
		$article_model = new ArticleModel();
		$article = $article_model->get_article($id);
		$view->assign("id",$article['Title']);
        $menu_links = [
            array("label" => "Main", "href" => ""),
            array("label" => "Admin Panel", "href" => "/adminpanel"),
            array("label" => "Categories", "href" => ""),
            array("label" => "About", "href" => ""),
            array("label" => "Contact", "href" => ""),
        ];
		$post_model = new PostModel();
        $posts = $post_model->getAll($id);
        $view->assign("menu_links", $menu_links);
		$view->assign("article",$article);
		$view->assign("posts",$posts);
        $view->display("blog/article.php");
	}
	function posts_post(){
		$articleID = $_POST["id"];
		$content = $_POST["content"];
		$userID = "1";	
		$post_model = new PostModel();
		$post_model->insert_post($articleID,$userID,$content);	
		$this->index_after_post($articleID);
		
	}
}


?>