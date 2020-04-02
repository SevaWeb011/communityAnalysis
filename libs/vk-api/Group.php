<?php
class Group extends Request
{

    public function getID($id):int //arg - string or int
    {
        $groupData = $this->_getDataGroup($id);
        if(empty($groupData["error"]))
            $groupID = $groupData["response"][0]["id"];
        else
            $groupID = 0;
        return $groupID;  
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

        return $this->_sendRequest($method, $getParams, $arrValidCode);
    }
}
?>