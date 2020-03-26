<?php
class Routing 
{
    private $controllerName = "Index";
    private $action = "main";
    const COUNT_SECTIONS = 2; //http://localhost/controller(1)/action(2)?params в ссылке возможны только 2 секции

    public function buildRoute():void
    {
        $this->_SetNames();
        $this->_includeFiles();

        $action = $this->action;
        $controllerName = $this->controllerName . "Controller";
        
        if(method_exists($controllerName, $action)){
            $controller = new $controllerName($action);
            $controller->$action();
        }
        else 
            $this->_defaultCall();

    }

    private function _setNames():void
    {
        $route = $this->_parseRequest();

        if ($this->_isTrueRequest($route)){
            $controller = ucfirst($route[1]);
            $action = lcfirst($route[2]);
            if($this->_isController($controller)){
                $this->controllerName = $controller;
                $this->action = $action; 
            } 
        }
    }

    private function _parseRequest():array
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $route = explode("/", $url);
        unset($route[0]);
            return $route;
    }

    private function _isTrueRequest($route):bool
    {
        if(count($route) == self::COUNT_SECTIONS)
            return true;
        else
            return false;
    }

    private function _isController($name):bool
    {
        if(is_file(CONTROLLER_PATH . ($name) . "Controller.php"))
            if(is_file(MODEL_PATH . ($name) . "Model.php"))
                return true;
        return false;
    }

    private function _includeFiles():void
    {
            require_once CONTROLLER_PATH . $this->controllerName . "Controller.php";

            require_once MODEL_PATH . $this->controllerName . "Model.php";
    }

    private function _defaultCall():void
    {
            $controller = new IndexController("main");
            $controller->main();
    }

    public function errorPage($appExeption):void//todo вынести в additional метод
    {
        echo "Я типо 500 ошибка, только красивая, потому что для юзеров";
        $appExeption->__toString();
        exit;
    }

}
?>