<?php
use Gondr\Route;

session_start();

define( "__ROOT", dirname(__DIR__));
define( "__VIEW", __ROOT . "/App/views");
define( "__CACHE", __ROOT . "/App/caches");

if(!file_exists(__CACHE)) {
    mkdir(__CACHE);
}

require __ROOT . "/vendor/autoload.php";
require __ROOT . "/web.php";

$url = isset($_GET['url']) ? "/"  . $_GET['url'] : "/";

Route::route($url);
