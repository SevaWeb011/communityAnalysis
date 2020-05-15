<?php
class AccountModel extends Model {
    const URL_AUTH =  "/libs/simple-php-vk-auth/auth.php";

    public function getLoginService():string
    {
        return "https://" . HOST . self::URL_AUTH;
    }

    public function getLogoutService():string
    {
        return "https://" . HOST . self::URL_AUTH . "/?logout=";
    }
}
?>