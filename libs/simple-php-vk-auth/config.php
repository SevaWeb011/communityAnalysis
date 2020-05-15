<?php
//Права, которые мы хотим получить (https://vk.com/dev/permissions)
$scope = [
    'groups'

];

$protocol = 'https://'; //Если у вас есть SSL-сертификат, то оставляем, иначе меняем на http://

define('APP_URL', "$protocol" . $_SERVER['HTTP_HOST']); //Ваш сайт/web-приложение
define('REDIRECT_URL', "$protocol" . $_SERVER['HTTP_HOST']. '/libs/simple-php-vk-auth/auth.php'); //Ссылка на скрипт авторизации через вк (файл auth.php, не путать с главной страницей вашего сайта, или той, на которой расположена кнопка 'Авторизоваться'. Ссылка на сам скрипт.)
define('APP_ID', '7198189'); //ID приложения (выдает ВК)
define('APP_SECRET', '3Kf673pXIr5OkoYLG9Mf'); //Защищённый ключ (выдает ВК)
define('APP_SERVICE_KEY', 'c3ca7035c3ca7035c3ca703549c3a7a5d8cc3cac3ca70359da718934fee35d9477e6048'); //Сервисный ключ доступа (выдает ВК)
define('ACCESS_TOKEN_URL', 'https://oauth.vk.com/access_token'); //не трогать
define('AUTH_URL', 'https://oauth.vk.com/authorize'); ////не трогать
define('AUTH_DIALOG_URL', AUTH_URL . '?' . 'client_id=' . APP_ID . '&redirect_uri=' . REDIRECT_URL . '&response_type=code&display=page&scope=' . implode(',', $scope)); //Вызов диалога авторизации через ВК
 
