<?php
class Routing 
{
    private $controllerName = "Index";
    private $action = "main";
    const COUNT_SECTIONS = 2; //http://localhost/1/2 в ссылке возможны только 2 секции

    public function buildRoute():void
    {
        $this->_SetNames();
        $this->_includeFiles();
    
        $action = $this->action;
        $controllerName = $this->controllerName . "Controller";
        $controller = new $controllerName($action);
        $controller->$action();

    }

    private function _setNames():void
    {
        $route = $this->_parseRequest();
        $countRoute = count($route) - 1;
        if (!empty($route)){
            for($i = $countRoute; $i > 0; $i--){
                $section = ucfirst($route[$i]);
                if(!empty($section)){
                    if($this->_isController($section))
                        $this->controllerName = $section;
                    else 
                        $this->action = lcfirst($section); 
                }
            }
        }
    }

    private function _parseRequest():array
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $route = explode("/", $url);
        
        if(count($route) - 1 == self::COUNT_SECTIONS)
            return $route;
        return [];
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

    public function errorPage(){
        
    }

}
?>