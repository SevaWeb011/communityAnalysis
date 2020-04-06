<?php
class Like extends Request
{
    public function getLikeList($id, $itemList)
    {
        $list = $this->_getPartList($itemList);
        $ScriptVK = "listLikes";
        $replaces = [
            '$wallList' => $list,
            '$ownerID' => "-".$id,
            '$version' => self::VERSION_API
        ];

        $code = $this->_initScriptVK($ScriptVK, $replaces);
        $resp = $this->_getLikeList($code);
        var_dump($resp);
        exit;

    }


    private function _getLikeList($code)
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

    private function _getPartList($list):string
    {
        for ($i = 0; $i < 25; $i++)
        {
            $resultList[$i] = $list[$i];

            if(empty($list[$i + 1]))
                break; 
        }
        return json_encode($resultList);
    }
}
?>