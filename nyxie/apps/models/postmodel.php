<?php

class PostModel
{
    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect("localhost", "root", "", "blogex");
    }
	public function getAll($id){
		$query = "select * from comments where ArticleID = " .$id;
		return $this->db->query($query);
	}
	public function insert_post($articleID,$userID,$content){
		$post =	array("UserID" => $userID,
			"Content" => $content,
			"ArticleID" => $articleID);
		$this->db->insert("comments",$post);
	}
	public function delete_post($postID){
		$query = "delete from comments where ID = " .$postID;
		$this->db->query($query);
	}
	
}

?>