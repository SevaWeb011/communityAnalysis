<?php
namespace App;
class User
{
    private $id;
    private $actions;
    private $activeScore;
    private $name;

    public function __construct($id)
    {
        $this->id = $id;
        $this->actions = new UserActions();
    }

    public function getID():int
    {
        return $this->id;
    }

    public function addLike($recordID):void
    {
        $this->actions->addLike($recordID);
    }

    public function addRepost($recordID):void
    {
        $this->actions->addRepost($recordID);
    }

    public function addComment($recordID):void
    {
        $this->actions->addComment($recordID);
    }


    public function setName($name):void
    {
       $this->name = $name;
    }

    public function getName():String
    {
        return $this->name;
    }

    public function getLikes():array
    {
        return $this->actions->getLikes();
    }

    public function getReposts():array
    {
        return $this->actions->getReposts();
    }

    public function getComments():array
    {
        return $this->actions->getComments();
    }
    

    public function setActiveScore():void
    {
        $scoreLike = count($this->actions->getLikes());
        $scoreComment = count($this->actions->getComments()) * 2;
        $scoreRepost = count($this->actions->getReposts()) * 3;

        $this->activeScore = $scoreLike +  $scoreComment + $scoreRepost;
    }

    public function getActiveScore():int
    {
        return $this->activeScore;
    }
}
?>