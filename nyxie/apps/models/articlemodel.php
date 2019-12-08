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
		
	$this->db->insert("articles",$article);
	$articleFromDb = $this->db->query("select * from articles where title = \"" . trim($title) . "\"");	
	$exploded_tags = explode("#",$tags);
	foreach ($exploded_tags as $tag){
		if(trim($tag) == "") {continue;}
		$dummy = array(
			"Tag" => $tag,
			"ArticleID" => $articleFromDb[0]["ID"]
		);
		$this->db->insert("Tags",$dummy);
	
	}
	
	}

}

?>