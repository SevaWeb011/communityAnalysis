<?php
class IndexModel extends Model {
    const URL_AUTH = "http://localhost/libs/simple-php-vk-auth/auth.php";

    public function getDataIndex()
    {
        session_start();
        $pageData = $this->_getReference();
        return $pageData;
    }

    private function _getReference():array
    {
        if(empty($_SESSION["token"])){
            $result['auth']['title'] = "Авторизоваться через VK";
            $result['auth']['src'] = self::URL_AUTH;
        } else{
            $result['auth']['title'] = "Выход из приложения";
            $result['auth']['src'] = self::URL_AUTH . "/?logout=";
        }
        return $result;
    }
}
?>