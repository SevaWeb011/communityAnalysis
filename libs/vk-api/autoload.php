<?php
require "APIExeption.php";
spl_autoload_register(function ($class) {
    include $_SERVER["DOCUMENT_ROOT"]. '/libs/vk-api/' . $class . '.php';
});
?>