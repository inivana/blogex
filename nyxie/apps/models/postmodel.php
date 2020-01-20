<?php

class PostModel
{
    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect("localhost", "root", "", "blogex");
    }
	public function getAll($id){
		$query = "select c.*,COALESCE(concat(u.LastName,' ',u.FirstName),
		'Annonymous') as user from comments c left join users 
		u on u.id = c.userID where ArticleID = " .$id;
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
	
	public function display_post_field($articleID){
		return $this->db->query("select blocked from users u inner join articles a
		on u.id = a.userId where a.id = " . $articleID) ;
	}
	
}

?>