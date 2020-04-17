<?php
class Group extends Request
{
    public function getID($id):int //arg - string or int
    {
        $groupID = 0;
        $groupData = $this->_getDataGroup($id);
        if(empty($groupData["error"]))
            $groupID = $groupData["response"][0]["id"];
        return $groupID;  
    }

    public function getName($id):string
    {
        $groupData = $this->_getDataGroup($id);
        $name = $groupData["response"][0]["name"];
        return $name;
    }

    public function getUserGroup($idUser)
    {
        $ScriptVK = "getUserGroup";
        $replaces = [
            '$idUser' => $idUser,
            '$version' => self::VERSION_API
        ];

        $code = $this->_initScriptVK($ScriptVK, $replaces);
        return $this->_sendExecute($code);
    }

    public function getGroupsData($list):array
    {
        $result=[];
        $count = 0;
        $listID = implode(",",$list);
        $groupData = $this->_getGroupsData($listID);
        foreach($groupData["response"] as $key=>$group){
            $result[$count]["id"] = $group["id"];
            $result[$count]["name"] = $group["name"];
            $result[$count]["photo"] = $group["photo_100"];
            $count++;
        }

        return $result;
    }

    public function getCountSubscriber($ids, $offset = 0)
    {
        $ids = json_encode($ids);
        $ScriptVK = "getCountSubscriber";
        $replaces = [
            '$ids' => $ids,
            '$version' => self::VERSION_API
        ];
        
        $code = $this->_initScriptVK($ScriptVK, $replaces);
        return $this->_sendExecute($code);


    }

    private function _getDataGroup($id)
    {
        $arrValidCode = [100];
        $method = "groups.getById";
        $requestParams = array(
            "group_id" => $id,
            'v' => self::VERSION_API,
            'access_token' => $this->token
            );
        $getParams = http_build_query($requestParams);

        $data = $this->_sendRequest($method, $getParams, $arrValidCode);
        return $data;
    }


    private function _getGroupsData($id):array
    {
        $method = "groups.getById";
        $requestParams = array(
            "group_ids" => $id,
            'v' => self::VERSION_API,
            'access_token' => $this->token
            );
        $getParams = http_build_query($requestParams);

        return $this->_sendRequest($method, $getParams);
    }

}
?>