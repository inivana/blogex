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
}