<?php
class Controller 
{
    private $model;
    private $view;
    private $pageData = array();

    public function __constructor() 
    {
        $this->view = new View();
        $this->model = new Model();
    }

    
}
?>