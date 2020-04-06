<?php
namespace App;
class User
{
    private $id;
    private $actions;
    private $activeScore;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function setActions($idGroup)
    {
        $this->actions = new UserActions($idGroup);
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
        $this->actions->addComment($recordID);;
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