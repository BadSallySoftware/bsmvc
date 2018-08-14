<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './Core/config.php';
include './Core/Controller.php';
include './Core/Database.php';
include './Core/Router.php';

global $db;

$db = new DatabaseConnection();

$db->createTable("testTAble", array("name" => "varchar(255)", "age" => "int(11)"));
$path = $_SERVER['PATH_INFO'];

$path = ltrim($path, '/');

//Set default page title
$title = "Bad Sally - MVC";


//Send the path to the router
Router::dispatch($path);
