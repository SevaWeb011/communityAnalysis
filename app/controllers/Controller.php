<?php
class Controller
{
    protected $model;
    protected $action;
    protected function __construct($action, $model)
    {
        $this->setModel($model);
        $this->action = $action;
    }

    protected function setModel($model)
    {
        $this->model = new $model();
    }
}
?>