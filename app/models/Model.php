<?php
 class Model 
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
        $this->user = new User($this->token);
        $this->wall = new Wall($this->token);
        $this->group = new Group($this->token);
        $this->db = new Db();
    }

    protected function goHome():void
    {
        header("Location: /");
    }
}
?>