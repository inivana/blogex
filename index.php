<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!defined('NYXIEPATH'))
    define('NYXIEPATH', 'nyxie/');

require_once(NYXIEPATH . 'nyxie.php');

Database::set_type("mysql");

$nyxie = new Nyxie;

$nyxie->register_controller("blog", "BlogController", true);
$nyxie->register_controller("adminpanel", "AdminPanelController");

$nyxie->start();