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

    public static function getUserAppID():int
    {
        $id = 0;
        if(!empty($_SESSION["userID"]))
            $id = $_SESSION["userID"];
        return $id;
            
    }
    
    public function getUserName($id):string
    {
        $name = "";
        $userData = $this->_getUserName($id);
        $name = $userData["response"][0]["first_name"];
        return $name;
    }

    public function getUserFullName($list):array
    {
        $result=[];
        $listID = implode(",",$list);
        $userData = $this->_getUserName($listID);
        foreach($userData["response"] as $key=>$user){
            $last = $user["last_name"];
            $name = $user["first_name"];
            $id = $user["id"];
            $result[$id] = $name." ".$last;
        }

        return $result;
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
        $resp = $this->_sendExecute($code);
        if(isset($resp["error"])) 
            throw new VKExeptions('Получена ошибка от внешнего сервиса: '.$resp["error"]["error_msg"]);
        return $resp;

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
}
?>