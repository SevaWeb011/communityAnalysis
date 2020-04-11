<?php
namespace App;
class Group
{
    private $id;
    private $name;
    private $photo;
    private $activeUsers = [];
    private $countSubscriber;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getActiveUsers():array
    {
        return $this->activeUsers;
    }

    public function getCountActiveUsers():int
    {
        return count($this->activeUsers);
    }

    public function getCountSubscriber():int
    {
        return $this->countSubscriber;
    }

    public function setCountSubscriber($count):void
    {
        $this->countSubscriber = $count;
    }


    public function setName($name):void
    {
        $this->name=$name;
    }

    public function setPhoto($photo):void
    {
        $this->photo=$photo;
    }


    public function addActiveUsers($id):void
    {
        $this->activeUsers[] = $id;
    }

}