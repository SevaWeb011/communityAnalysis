<?php 
class CalculationController extends Controller 
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
        $template = ROOT . "/views/calculation/" . $this->action . ".tpl.php";
        $this->pageTemplate = $template;
    }

    public function start() 
    {
        $this->pageData["title"] = "Анализ";
        $this->view->render($this->pageData);
    } 

    public function analysis() //async Action
    {
        $report["report"] = $this->model->getNewReport();//TODO return id report
        $report = json_encode($report);
        echo $report;
    } 
}
?>