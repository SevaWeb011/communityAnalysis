<?php
abstract class Model 
{
    protected $wall;
    protected $like;
    protected $group;
    protected $user;
    protected $token;
    protected $db = null;

    public function __construct() 
    {
        if (User::isUserToken())
        $this->token = $_SESSION["token"];
    else 
        $this->goHome();
        $this->user = new User($this->token);
        $this->wall = new Wall($this->token);
        $this->group = new Group($this->token);
        $this->db = DB::connectToDB();
    }

    protected function goHome():void
    {
        header("Location: /");
    }
}
?>