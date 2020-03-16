<?php
class Authorization
{
    private $_code; //Код, необходимый для получения токена
    private $_token; //Собственно, токен
    private $_secret; //Ключ, необходимый для осуществления запросов через http соединение
    private $_userId; //ID авторизовавшегося пользователя

    public function __construct()
    {
        require_once('config.php');
    }

    public function setCode($code):void
    {
        $this->_code = $code;
    }

    private function _setToken($token):void
    {
        $this->_token = $token;
    }

    private function _setSecret($secret):void
    {
        $this->_secret = $secret;
    }

    private function _setUserId($userId):void
    {
        $this->_userId = $userId;
    }

    private function _callExeption($message, $code = 0, $previous = null):void
    {
        throw new authorizationExeptions ($message, $code, $previous);
    }
    
    public function authorization()
    {
        $authJson = $this->_getAuthhorizationJson();
        $this->_initFields($authJson);
        $this->_startSession();
        $this->_redirect(APP_URL);

    }

    private function _getAuthhorizationJson():String
    {
        if (!$this->_code) {
            $this->_callExeption('GET["CODE"] отсутствует!');
        }
        $curl = curl_init();
        $requestParams = 'client_id=' . APP_ID . '&client_secret=' . APP_SECRET . '&code=' . $this->_code . '&redirect_uri=' . REDIRECT_URL;
        curl_setopt($curl, CURLOPT_URL, ACCESS_TOKEN_URL . '?' . $requestParams);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl); 
            if(empty($result))
                $this->_callExeption("Внешний сервис не ответил на запрос токена!");
            return $result;
    }

    private function _initFields($authJson):void
    {
        if(empty($authJson))
            $this->_callExeption("Получен пустой объект -> _initField");
            $authObject = json_decode($authJson);
        if ($authObject->access_token) {
            $this->_setToken($authObject->access_token);
            $this->_setUserId($authObject->user_id);
            $this->_setSecret($authObject->secret);
        } else
            $this->_callExeption("Внешний сервис не дал access_token");
    }

    private function _startSession():void
    {
        session_start();
        $_SESSION['token'] = $this->_token;
        $_SESSION['secret'] = $this->_secret;
        $_SESSION['userID'] = $this->_userId;
    }

    private function _redirect($url):void
    {

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url);
        exit();
    }

    public function callCodeOfAuthorization():void
    {
        $this->_redirect(AUTH_DIALOG_URL);
    }

    public function logout():void
    {
        session_start();
        session_destroy();
        $this->_redirect(APP_URL);
    }
}