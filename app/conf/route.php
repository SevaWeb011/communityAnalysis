<?php
class Routing 
{
    public function buildRoute()
    {
        //default
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";

        $route = $this->_parseURI();

        if(!empty($route["controller"]) && !empty($route["model"])){
            $controllerName = $route["controller"];
            $modelName = $route["model"];
        }
        $this->_includeFiles($controllerName, $modelName);
        if(!empty($route["action"])) 
            $action = $route["action"];
    
        $controller = new $controllerName();
        $controller->$action();
    }

    private function _parseURI():array
    {
        $result = [];
        $uri = explode("/", $_SERVER['REQUEST_URI']);

        if(!empty($uri[1])) {
            $result["controller"] = ucfirst($uri[1] . "Controller");
            $result["model"] = ucfirst($uri[1] . "Model");
        }
        if(!empty($uri[2])){
            $result["action"] = $uri[2];
        }

        return $result;
    }

    private function _includeFiles($controllerName, $modelName)
    {
        require_once CONTROLLER_PATH . $controllerName . ".php";

        require_once MODEL_PATH . $modelName . ".php";
    }

    public function errorPage(){
        
    }

}
?>