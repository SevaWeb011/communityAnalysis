<?php

 //var_dump($_SERVER["REMOTE_ADDR"]);
 if($_SERVER["REMOTE_ADDR"] != "")
    exit;
require_once("libs/dev/dev.php");
require_once("libs/vk-api/autoload.php");
require_once("app/additional/AppExeptions.php");
require_once("app/conf/config.php");


?>