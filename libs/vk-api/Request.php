<?php
 class Request
{
    const PATH_SERVICE = "https://api.vk.com/method";
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public static function isUserToken():bool
    {
        if (!empty($_SESSION["token"]) && !empty($_SESSION["userID"]))
            return true;
        else
            return false;
    }
}
?>