<?php 
class ReportsController extends Controller 
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
        $template = ROOT . "/views/reports/" . $this->action . ".tpl.php";
        $this->pageTemplate = $template;
    }

    public function all():void
    {
        $this->pageData["title"] = "Все отчеты";
        $this->pageData["reports"] = $this->model->getReports();
        $this->view->render($this->pageData);
    }

    public function select():void
    {
        $this->pageData["title"] = "Отчет";
        $this->pageData["groups"] = $this->model->getGroups();
        $this->view->render($this->pageData);
    }

}
?>