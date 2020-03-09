<?php
require_once("libs/dev/dev.php");
session_start();
if(empty($_SESSION["token"])):
?>
<a href='http://localhost/libs/simple-php-vk-auth/auth.php'>Авторизация через ВК</a>
<?php
else:
?>
<a href='http://localhost/libs/simple-php-vk-auth/auth.php?logout='>Выход из приложения</a>
<?php
endif;
?>