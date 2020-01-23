<?php

class BlogController extends Nyxie
{
    function index()
    {
        $article_model = new ArticleModel();
        $articles = $article_model->get_all();

        // Trim articles content
        // TODO: Evaluate category name by id
        for ($i = 0; $i < count($articles); $i++) {
            $articles[$i]["Content"] = substr($articles[$i]["Content"], 0, 350) . "...";
        }

        $view = new View();

        $menu_links = [
            array("label" => "Main", "href" => ""),
            array("label" => "Admin Panel", "href" => "adminpanel"),
            array("label" => "Categories", "href" => ""),
            array("label" => "About", "href" => ""),
            array("label" => "Contact", "href" => ""),
        ];

        $view->assign("content_file", "articles-container.php");
        $view->assign("articles", $articles);
        // TODO: To be decided if menu will be configurable
        $view->assign("menu_links", $menu_links);

        $view->display("blog/main.php");
    }

    function categories()
    {

    }
}