<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './Core/config.php';
include './Core/Controller.php';
include './Core/Database.php';

$db = new DatabaseConnection();

$db->createTable("testTAble", array("name" => "varchar(255)", "age" => "int(11)"));
$path = $_SERVER['PATH_INFO'];

$path = ltrim($path, '/');
$pathArray = explode('/', $path);

$args = array();
foreach($pathArray as $chunk)
{
    array_push($args, $chunk);
}

$controller = $args[0];

if(file_exists('./App/Controllers/' . $controller . ".php"))
{
    include './App/Controllers/' . $controller . ".php";
    $controllerName = ucfirst($controller) . "Controller";   
    $cInstance = new $controllerName();
    $cInstance->index();
}
