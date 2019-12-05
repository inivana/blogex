<?php

class ArticleModel
{
    public function __construct()
    {
        $this->db = Database::set_type("mysql");
        $this->db->connect("localhost", "root", "");
    }

    public function get_all()
    {
        return $this->db->select(["*"], "articles");
    }
}