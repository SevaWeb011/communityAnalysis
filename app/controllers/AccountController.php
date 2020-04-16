<?php
class AccountController extends Controller 
{
    public function __construct($action, $model)
    {
        parent::__construct($action, $model);
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