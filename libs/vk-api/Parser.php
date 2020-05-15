<?php
class Parser
{
    const PATH_SERVICE = "https://vk.com/al_wall.php";

    public function getWalls()
    {
        $requestParams = array(
            "act" => "get_wall",
            "owner_id" => "-39499734",
            "offset" => 19, 
            "onlyCache" => false,
            "type" => "own",
            "wall_start_form" => 20
            );
        $params = http_build_query($requestParams);

        $response =  $this->_sendRequest($params);
    }

    private function _sendRequest($postParams)
    {

        $curl = curl_init(self::PATH_SERVICE);
        curl_setopt ($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);//headers

        curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/80.0.3987.149 Chrome/80.0.3987.149 Safari/537.36!');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-type' => 'application/x-www-form-urlencoded', 
            "accept-encoding" => "gzip, deflate, br",
            "accept-language" => "ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7"
        ));
        // curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($curl, CURLOPT_COOKIEFILE, "cookie.txt");
        // curl_setopt ($curl, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'] . '/cookie.txt');
        // curl_setopt ($curl, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'] . '/cookie.txt');
        curl_setopt($curl, CURLOPT_POSTFIELDS,$postParams);
        $response = curl_exec($curl);
        //$response = gzdecode($response);
        curl_close($curl); 
        print_r("<pre>".$response."</pre>");
       echo 11111;
    }

   public static function testRequest()
   {

   }
}
?>