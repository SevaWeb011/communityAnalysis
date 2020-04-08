<?php
namespace App;
class UserActions
{
    private $likes = [];
    private $comments = [];
    private $reposts = [];

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
}
?>