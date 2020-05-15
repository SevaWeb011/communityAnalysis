<?php
class IndexController extends Controller 
{
    private $view;
    private $pageData;


    public function __construct($action, $model)
    {
        parent::__construct($action, $model);
    }


    public function test():void
    {
        $this->model->run();
    } 
}
?>