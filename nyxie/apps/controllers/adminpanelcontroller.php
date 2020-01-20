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
	
		//delete comes from mode_comments view
	function delete_article_post(){
		$id = $_POST['id'];
		$article_model = new ArticleModel();
		$article_model->delete_article($id);	
		$this->index();
	}
	
	//delete comes from mode_comments view
	function delete_post_post(){
		$id = $_POST['id'];
		$articleID = $_POST['articleID'];
		$post_model = new PostModel();
		$post_model->delete_post($id);	
		$this->mode_comments_after_delete_post($articleID);
	}
	
	
	//view for mode - comments
	function mode_comments_after_delete_post($cachedArticleID){
		$view = new View();
		$post_model = new PostModel();
		$posts = $post_model->getAll($cachedArticleID);
		$view->assign("menu_bar", "left-menu.php");
		$view->assign("posts", $posts);
        $view->display("edit-posts.php");
	}
	//view for mode - comments
	function mode_comments_get(){
		$view = new View();
		$post_model = new PostModel();
		$posts = $post_model->getAll($_GET["id"]);
		$view->assign("menu_bar", "left-menu.php");
		$view->assign("posts", $posts);
        $view->display("edit-posts.php");
	}

	function add_article()
    {
        $view = new View();
		$view->assign("menu_bar", "left-menu.php");
        $view->display("add-article.php");
    }
	
	
	function add_article_post()
    {
		$content = $_POST['content'];
		$title = $_POST['title'];
		$categoryID = "1";
		$userID = Session::get_user_id();
		$tags = $_POST['tags'];
        $view = new View();
		$article_model = new ArticleModel();
		$article_model->insert_article($userID,$content,$title,$categoryID,$tags);
		$view->assign("menu_bar", "left-menu.php");
        $view->display("add-article.php");
    }


	function settings(){
		$view = new View();
		$um = new UserModel();
		$data = $um->get_user_informations(Session::get_user_id());
		$view->assign("articles",$data[0]["articles"]);
		$view->assign("comments",$data[0]["comments"]);
		$view->assign("firstname",$data[0]["FirstName"]);
		$view->assign("lastname",$data[0]["LastName"]);
		$view->assign("email",$data[0]["email"]);
		$view->assign("blocked",$data[0]["blocked"]);
		$view->assign("premium",$data[0]["premium"]);
		$view->assign("menu_bar", "left-menu.php");
        $view->display("settings.php");
	}
	
	function settings_post(){
		$view = new View();
		if(isset($_POST["old-password"])){
			$old_password = $_POST["old-password"];
			$new_password = $_POST["new-password"];
			$um = new UserModel();
			$um->change_password($old_password,$new_password,Session::get_user_id());
		}
		else if(isset($_POST["comment-permission"])){
			$um = new UserModel();
			$um->block_comments(0,Session::get_user_id());
		}else{
			$um = new UserModel();
			$um->block_comments(1,Session::get_user_id());
		}
        $this->settings();
	}
	
	 
}