<?php

class ArticleModel
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function get_all()
    {
        return $this->db->query("select * from articles");
    }
	public function get_article($id){
		return $this->db->query("select * from articles where ID = \"" . trim($id) . "\"")[0];	
	}
	public function get_article_tags($id){
		return $this->db->query("select * from tags where ArticleID = \"" . trim($id) . "\"");	
	}
	public function update_article($id,$content,$title,$categoryID,$tags){
		$this->db->query("update articles set Title = \"" . $title."\", Content = \"". $content . "\", CategoryID = " . $categoryID . " where ID = " . $id. "");	
		$this->db->query("delete from tags where ID = " . $id. "");
		$exploded_tags = explode("#",$tags);
		foreach ($exploded_tags as $tag){
			if(trim($tag) == "") {continue;}
			$dummy = array(
				"Tag" => $tag,
				"ArticleID" => $id
			);
			$this->db->insert("Tags",$dummy);		
		}			
	}
	public function delete_article($id){
		$this->db->query("delete from articles where ID = " . $id. "");
		$this->db->query("delete from tags where ArticleID = " . $id. "");
		$this->db->query("delete from comments where ArticleID = " . $id. "");
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