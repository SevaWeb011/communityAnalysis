<?php
class IndexController extends Controller 
{
    private $view;
    private $pageTemplate;
    private $pageData;


    public function __construct($action, $model)
    {
        parent::__construct($action, $model);
        $this->_setTemplate();
        $this->view = new View($this->pageTemplate);
    }

    private function _setTemplate():void
    {   
        $template = ROOT . "/views/main/" . $this->action . ".tpl.php";
        $this->pageTemplate = $template;
    }
 
    public function main() 
    {
            $userName = $this->model->getUserName();
            $this->pageData["user_name"] = $userName;
            $this->pageData["title"] = "Главная";
            $this->view->render($this->pageData);
            $db = new Migrate();
            //$db->createTables();
            //$db->removeTables();
    } 
}
?>