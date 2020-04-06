<?php
// spl_autoload_register(function ($class) {
//     ini_set('error_reporting', E_ALL & ~E_WARNING);
//     include $_SERVER["DOCUMENT_ROOT"]. '/app/additional/' . $class . '.php';
//     ini_set('error_reporting', E_ALL);
// });
require_once($_SERVER["DOCUMENT_ROOT"]. '/app/additional/AppExeptions.php');
require_once($_SERVER["DOCUMENT_ROOT"]. '/app/additional/User.php');
require_once($_SERVER["DOCUMENT_ROOT"]. '/app/additional/UserActions.php');
?>