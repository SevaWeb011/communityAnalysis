<?php
if(!empty($_SESSION["token"])):
?>
<a href='http://localhost/libs/simple-php-vk-auth/auth.php'>Авторизация через ВК</a>
<?php
endif;
session_start();

?>