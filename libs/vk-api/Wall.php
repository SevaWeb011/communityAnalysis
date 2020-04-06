<?php
class Wall extends Request
{
    public function getListID($id, $maxCountWall = 100):array
    {
        $ScriptVK = "listWall";
        $replaces = [
            '$maxCountWall' => $maxCountWall,
            '$ownerID' => "-".$id,
            '$version' => self::VERSION_API
        ];

        $code = $this->_initScriptVK($ScriptVK, $replaces);
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