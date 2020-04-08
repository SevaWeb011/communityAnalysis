<?php
namespace App;
class Group
{
    private $id;
    private $name;
    private $photo;
    private $activeUsers = [];

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function setName($name):void
    {
        $this->name=$name;
    }

    public function setPhoto($photo):void
    {
        $this->photo=$photo;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function addActiveUsers($id):void
    {
        $this->activeUsers[] = $id;
    }

    public function getActiveUsers():array
    {
        return $this->activeUsers;
    }

    public function getCountActiveUsers():int
    {
        return count($this->activeUsers);
    }
}