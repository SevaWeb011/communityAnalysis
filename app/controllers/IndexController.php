<?php
class IndexController extends Controller 
{
    private $model;
    private $view;
    private $action;
    private $pageTemplate;
    private $pageData;


    public function __construct($action)
    {
        $this->action = $action;
        $this->model = new IndexModel();
        $this->pageTemplate = $this->_getTemplate();
        $this->view = new View($this->pageTemplate);
    }

    private function _getTemplate():string
    {   
        $template = ROOT . "/views/main/" . $this->action . ".tpl.php";
        return $template;
    }

    public function main() 
    {
        $userName = $this->model->getUserName();
        $this->pageData["user_name"] = $userName;
        $this->view->render($this->pageData);
    }
}
?>