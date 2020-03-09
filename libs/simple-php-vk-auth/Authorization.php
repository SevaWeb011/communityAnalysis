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
    
    public function authorization()
    {
        $authJson= $this->_getAuthhorizationJson();
        $this->_initFields($authJson);
        $this->_startSession();
        $this->redirect(APP_URL);

    }

    private function _getAuthhorizationJson():String
    {
        if (!$this->_code) {
            exit('GET["CODE"] отсутствует!');
        }
        $curl = curl_init();
        $requestParams = 'client_id=' . APP_ID . '&client_secret=' . APP_SECRET . '&code=' . $this->_code . '&redirect_uri=' . REDIRECT_URL;
        curl_setopt($curl, CURLOPT_URL, ACCESS_TOKEN_URL . '?' . $requestParams);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);
        if (empty($result)) 
            exit('Внешний сервис дал некорректный ответ -> _getAuthhorizationObject');
        return $result;
    }

    private function _initFields($authJson):void
    {
        if(empty($authJson))
            exit("Получен пустой объект -> _initField");
            $authObject = json_decode($authJson);
        if ($authObject->access_token) {
            $this->_setToken($authObject->access_token);
            $this->_setUserId($authObject->user_id);
            $this->_setSecret($authObject->secret);
        }
    }

    private function _startSession():void
    {
        session_start();
        $_SESSION['token'] = $this->_token;
        $_SESSION['secret'] = $this->_secret;
        $_SESSION['userId'] = $this->_userId;
    }

    public function redirect($url):void
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url);
        exit();
    }

    public function logout():void
    {
        session_start();
        session_destroy();
        $this->redirect(APP_URL);
    }


}