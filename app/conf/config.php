<?php
define ("ROOT", $_SERVER["DOCUMENT_ROOT"] . "/app");
define ("HOST", $_SERVER["HTTP_HOST"]);
define ("CONTROLLER_PATH", ROOT."/controllers/");
define ("MODEL_PATH", ROOT."/models/");
define ("VIEW_PATH", ROOT."/views/");
define ("LAYOUT_PATH", ROOT."/views/layouts/");

define ("DB_USER", "s179098");
define ("DB_PASS", "otherpassword");
define ("DB_HOST", "localhost");
define ("DB_NAME", "appvk");

// define ("DB_USER", "root");
// define ("DB_PASS", "3101"); 
// define ("DB_HOST", "localhost");
// define ("DB_NAME", "appVK"); 

require_once("db.php"); 

require_once("route.php"); 

require_once MODEL_PATH.'Model.php';

require_once VIEW_PATH.'View.php';

require_once CONTROLLER_PATH.'Controller.php';

session_start();
$routing = new Routing();
$routing->buildRoute();
?>

