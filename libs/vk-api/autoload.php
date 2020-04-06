<?php
require "APIExeption.php";
spl_autoload_register(function ($class) {
    ini_set('error_reporting', E_ALL & ~E_WARNING);
    include $_SERVER["DOCUMENT_ROOT"]. '/libs/vk-api/' . $class . '.php';
    ini_set('error_reporting', E_ALL);
});
?>