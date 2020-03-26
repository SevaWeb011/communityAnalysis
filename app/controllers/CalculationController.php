<?php
class CalculationController extends Controller 
{
    private $model;
    private $view;
    private $action;
    private $pageTemplate;
    private $pageData;


    public function __construct($action)
    {
        $this->action = $action;
        $this->model = new CalculationModel();
        $this->_setTemplate();
        $this->view = new View($this->pageTemplate);
    }

    private function _setTemplate():string
    {   
        $template = ROOT . "/views/calculation/" . $this->action . ".tpl.php";
        $this->pageTemplate = $template;
        return $template;
    }

    public function start() 
    {
        $this->view->render();
    } 
}
?>