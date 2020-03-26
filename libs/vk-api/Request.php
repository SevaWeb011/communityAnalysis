<?php
 abstract class Request
{
    const PATH_SERVICE = "https://api.vk.com/method";
    const VERSION_API = "5.103";
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    private function _validResponse($response):void
    {
        if (empty($response))
            throw new APIExeptions("Запрос не дошел до внешнего сервиса или получен пустой ответ");
        if (isset($response["error"])){
            $error = $response["error"]["error_msg"];
            throw new APIExeptions("Внешний сервис прислал ошибку: $error");
        }
    }

    protected function _sendRequest($method, $getParams):array
    {
        $request = self::PATH_SERVICE . "/$method?" .$getParams;
        $responseJSON = file_get_contents($request);
        $response = json_decode($responseJSON, true);
        $this-> _validResponse($response);
        return $response;
    }
}
?>