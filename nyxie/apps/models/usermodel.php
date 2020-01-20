<?php

class UserModel
{
    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect("localhost", "root", "", "blogex");
    }

   public function change_password($old_password,$new_password,$user_id){
	   $query = "update users set password = '" . hash('sha256',$new_password) 
	   . "' where id = ". $user_id ." and password = '" . hash('sha256',$old_password) ."'";
	   return $this->db->query($query);
   }
   
   
   public function change_email($password,$new_email,$user_id){
	   $query = "update users set email = '" . $new_email 
	   . "' where id = ". $user_id ." and password = '" . hash('sha256',$password) ."'";
	   return $this->db->query($query);
   }


   public function get_user_informations($user_id){
	   $query = "select email,blocked,(case premium when premium = 1 then 'Premium' else 'Non-Premium' end) as premium,FirstName,LastName,(select count(*) from articles) as articles,
			(select count(*) from comments) as comments from users where id = " . $user_id;	
	   return $this->db->query($query);
   }
   public function block_comments($blocked,$user_id){
	   $query = "update users set blocked = " . $blocked .  " where id = " . $user_id;	
	   return $this->db->query($query);
   }
}

?>