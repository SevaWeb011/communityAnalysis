<?php

   //var_dump($_SERVER["REMOTE_ADDR"]);
 if($_SERVER["REMOTE_ADDR"] != "178.65.23.5"){
   echo"<h1>Уважаемый, вы не знаете пароль, Вам не пройти! </h1><br />";
   echo'<img src="/1.jpg">';
   exit;
 }
require_once("libs/dev/dev.php");
require_once("app/additional/autoload.php");
require_once("libs/vk-api/autoload.php");
require_once("app/conf/config.php");


?>