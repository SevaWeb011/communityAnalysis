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
        $userData = $this->_getUserName($id);
        $name = $userData["response"][0]["first_name"];
        return $name;
    }

    public function getActionLists($groupID, $recordID):array
    {
        $ScriptVK = "getUserActions";
        $replaces = [
            '$ownerID' => "-".$groupID,
            '$version' => self::VERSION_API,
            '$recordID' => $recordID
        ];

        $code = $this->_initScriptVK($ScriptVK, $replaces);
        return $this->_getActionLists($code);

    }
    
    private function _getUserName($id):array
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

    private function _getActionLists($code):array
    {
        $method = "execute";
        $requestParams = array(
            "code" => $code,
            'access_token' => $this->token,
            "v" => self::VERSION_API
            );
            $getParams = http_build_query($requestParams);
        $response =  $this->_sendRequest($method, $getParams);
        return $response["response"];
    } 

    
}
?>