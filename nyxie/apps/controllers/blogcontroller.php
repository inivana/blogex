<?php

class BlogController extends Nyxie
{
    function index()
    {
        $view = new View();

        // TODO: That will come from DB
        $articles = [
            array(
                "title" => "Blogex release incoming!",
                "category" => "Releases",
                "date" => "11.04.2019 15:45",
                "brief" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt risus ut dui ultrices mollis. Nam tincidunt augue vitae ante congue, vitae pulvinar erat eleifend. Aliquam ultricies lacinia eros at imperdiet. Vivamus vulputate leo et sapien tempor vehicula. Pellentesque a blandit velit. Nam odio tellus, vestibulum vitae leo at, varius pulvinar lectus..."
            ),
            array(
                "title" => "Project deadline is coming to the town.",
                "category" => "Christmas",
                "date" => "23.12.2019 15:45",
                "brief" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt risus ut dui ultrices mollis. Nam tincidunt augue vitae ante congue, vitae pulvinar erat eleifend. Aliquam ultricies lacinia eros at imperdiet. Vivamus vulputate leo et sapien tempor vehicula. Pellentesque a blandit velit. Nam odio tellus, vestibulum vitae leo at, varius pulvinar lectus..."
            ),
            array(
                "title" => "Demanded gifts are on the way.",
                "category" => "Santa Claus",
                "date" => "06.12.2019 12:34",
                "brief" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt risus ut dui ultrices mollis. Nam tincidunt augue vitae ante congue, vitae pulvinar erat eleifend. Aliquam ultricies lacinia eros at imperdiet. Vivamus vulputate leo et sapien tempor vehicula. Pellentesque a blandit velit. Nam odio tellus, vestibulum vitae leo at, varius pulvinar lectus..."
            ),
            array(
                "title" => "All you had to do was follow the damn train, CJ!",
                "category" => "GTA",
                "date" => "04.07.2012 09:31",
                "brief" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt risus ut dui ultrices mollis. Nam tincidunt augue vitae ante congue, vitae pulvinar erat eleifend. Aliquam ultricies lacinia eros at imperdiet. Vivamus vulputate leo et sapien tempor vehicula. Pellentesque a blandit velit. Nam odio tellus, vestibulum vitae leo at, varius pulvinar lectus..."
            ),
        ];

        $menu_links = [
            array("label" => "Main", "href" => ""),
            array("label" => "Admin Panel", "href" => "/adminpanel"),
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