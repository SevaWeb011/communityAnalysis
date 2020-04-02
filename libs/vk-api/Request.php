<?php
 abstract class Request
{
    const PATH_SERVICE = "https://api.vk.com/method";
    const VK_SKRIPT_PATH = "libs/vk-api/executeAPI/";
    const VERSION_API = "5.103";
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
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
        $request = self::PATH_SERVICE . "/$method?" .$getParams;
        $responseJSON = file_get_contents($request);
        $response = json_decode($responseJSON, true);
        $this-> _validResponse($response, $validCode);
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
}
?>