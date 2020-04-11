<?php
 class Request
{
    const PATH_SERVICE = "https://api.vk.com/method";
    const VK_SKRIPT_PATH = "libs/vk-api/executeAPI/";
    const VERSION_API = "5.103";
    protected $token;
    private $controlRequest;

    public function __construct($token)
    {
        $this->token = $token;
        $this->controlRequest["count"] = 0;
        $this->controlRequest["period"] = 0;
    }


    private function _validResponse($response, $validCode):void
    {
        if (empty($response))
            throw new VKExeptions("Запрос не дошел до внешнего сервиса или получен пустой ответ");
        if (isset($response["error"])){
            if (in_array($response["error"]["error_code"], $validCode))
                true;
            else{
                $error = $response["error"]["error_msg"];
                throw new VKExeptions("Внешний сервис прислал ошибку: $error");
            }
        }
    }

    protected function _sendRequest($method, $getParams, $validCode=[]):array
    {
        $time = microtime(true);
        $request = self::PATH_SERVICE . "/$method?" .$getParams;
        $responseJSON = file_get_contents($request);
        $response = json_decode($responseJSON, true);

        $this-> _validResponse($response, $validCode);
        $this->_requestControll($time);
            return $response;
    }


    protected function _initScriptVK($nameScript, $args)
    {
        $script = $nameScript.".txt";
        $code = file_get_contents(self::VK_SKRIPT_PATH.$script);

        foreach ($args as $arg=>$replace)
        {
            $code = str_replace($arg, $replace, $code);
        }
        return $code;
    }

    protected function _sendExecute($code):array
    {
        $time = microtime(true);
        $method = "execute";
        $requestParams = array(
            "code" => $code,
            'access_token' => $this->token,
            "v" => self::VERSION_API
            );
            $getParams = http_build_query($requestParams);
        $response =  $this->_sendRequest($method, $getParams);
        $this->_requestControll($time);
        return $response["response"];
    }

    private function _requestControll($time)
    {
        $count = &$this->controlRequest["count"];
        $period = &$this->controlRequest["period"];

        $count++;
        $period += round(microtime(true) - $time, 6);

        if($count % 3 == 0)
        {
            $diff = round(1 - $period, 6) * 1000000;
            $period = 0;
            if($diff > 0)
                usleep($diff);
        }
    }
}
?>