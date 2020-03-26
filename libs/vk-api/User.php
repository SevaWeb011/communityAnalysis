<?php
class User extends Request
{

    public static function isUserToken():bool
    {
        if (!empty($_SESSION["token"]) && !empty($_SESSION["userID"]))
            return true;
        else
            return false;
    }
    
    public function getUserName($id):string
    {
        $name = "";
        $userData = $this->_getUserData($id);
        $name = $userData["response"][0]["first_name"];
        return $name;
    }

    private function _getUserData($id):array
    {
        $method = "users.get";
        $requestParams = array(
            "user_ids" => $id,
            "name_case" => "nom", 
            'v' => self::VERSION_API,
            'access_token' => $this->token
            );
        $getParams = http_build_query($requestParams);

        return $this->_sendRequest($method, $getParams);
    }
}
?>