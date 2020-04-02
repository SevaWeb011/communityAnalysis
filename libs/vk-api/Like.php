<?php
class Like extends Request
{
    public function getLikeList($id, $itemList)
    {
        $likeList = [];
        foreach ($itemList as $wall){
            $list = $this->_getResponse($id,$wall);
            $likeList = array_merge($likeList, $list);
        }
        var_dump($likeList);
    }

    private function _getResponse($id, $item):array
    {
        $method = "likes.getList";
        $requestParams = array(
            "type" => "post",
            "owner_id" => "-".$id,
            "item_id" => $item,
            "count" => 100,
            'access_token' => $this->token,
            "v" => self::VERSION_API
            );
            $getParams = http_build_query($requestParams);

        $response =  $this->_sendRequest($method, $getParams);
 
        return $response;
    }
}
?>