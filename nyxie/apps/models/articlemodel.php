<?php

class ArticleModel
{
    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect("localhost", "root", "", "blogex");
    }

    public function get_all()
    {
        return $this->db->select("*", "articles");
    }
	
	public function insert_article($userID,$content,$title,$categoryID,$tags){
	$article =array(
				"CategoryID"  => $categoryID,
				"Content"  => $content,
				"Title"  => $title,
				"UserID"  => $userID 
			);
			echo"<script>console.log(". $tags . ");</script>";
	
	$this->db->insert("articles",$article);
	}

}

?>