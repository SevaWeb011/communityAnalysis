<?php
namespace App;
class UserActions
{
    private $likes = [];
    private $comments = [];
    private $reposts = [];
    private $countLike = 0;
    private $countComment = 0;
    private $countRepost = 0;

    public function addLike($recordID):void
    {
        $this->likes[] = $recordID;
    }

    public function addRepost($recordID):void
    {
        $this->reposts[] = $recordID;
    }

    public function addComment($recordID):void
    {
        $this->comments[] = $recordID;
    }

    public function getLikes():array
    {
        return $this->likes;
    }

    public function getReposts():array
    {
        return $this->reposts;
    }

    public function getComments():array
    {
        return $this->comments;
    }

    public function getCountLike():int
    {
        return $this->countLike;
    }

    public function getCountRepost():int
    {
        return $this->countRepost;
    }

    public function getCountComment():int
    {
        return $this->countComment;
    }

    public function setCountLike($count):void
    {
        $this->countLike = $count;
    }

    public function setCountRepost($count):void
    {
        $this->countRepost = $count;
    }

    public function setCountComment($count):void
    {
        $this->countComment = $count;
    }
}
?>