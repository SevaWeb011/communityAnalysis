<?php
require_once('Authorization.php');
require_once('../dev/dev.php');

$auth = new Authorization();

if (isset($_GET['logout']))
    $auth->logout();

if (!$_GET['code']) {
    $auth->redirect(AUTH_DIALOG_URL);
} else {
     $auth->setCode($_GET['code']);
     $auth->authorization();
}
?>