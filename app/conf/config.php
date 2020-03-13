<?php
define ("ROOT", $_SERVER["DOCUMENT_ROOT"] . "/app");
define ("CONTROLLER_PATH", ROOT."/controllers/");
define ("MODEL_PATH", ROOT."/models/");
define ("VIEW_PATH", ROOT."/views/");

define ("DB_USER", "");
define ("DB_PASS", "");
define ("DB_HOST", "localhost");
define ("DB_NAME", "");

require_once("db.php");

require_once("route.php");

require_once MODEL_PATH.'Model.php';

require_once VIEW_PATH.'View.php';

require_once CONTROLLER_PATH.'Controller.php';

$routing = new Routing();
$routing->buildRoute();
?>

