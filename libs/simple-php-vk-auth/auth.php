<?php
require_once('class/Authorization.php');

require_once('class/authorizationExeptions.php');

require_once('../dev/dev.php');

$auth = new Authorization();

if (isset($_GET['logout'])){
    $auth->logout();
}

if (!$_GET['code']) {
    $auth->callCodeOfAuthorization();
} else {
     $auth->setCode($_GET['code']);
     $auth->authorization();
}
?>