<?php
class AccountController extends Controller 
{
    private $model;
    private $view;
    private $action;


    public function __construct($action)
    {
        $this->action = $action;
        $this->model = new AccountModel();
    }

    public function login():void
    {
        $url = $this->model->getLoginService();
        header("Location: " . $url);
    }

    public function logout():void
    {
        $url = $this->model->getLogoutService();
        header("Location: " . $url);
    }
}
?>