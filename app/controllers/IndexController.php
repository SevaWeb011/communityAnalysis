<?php
class IndexController extends Controller 
{
    private $pageTemplate = "/views/main.tpl.php";

    public function __construct()
    {
        $this->model = new IndexModel();
        $this->view = new View();
    }

    public function index() 
    {
        $this->pageData = $this->model->getDataIndex();
        $this->view->render($this->pageTemplate, $this->pageData);
    }
}
?>