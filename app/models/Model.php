<?php
class Model 
{
    private $db = null;

    public function __construct() 
    {
        $this->db = DB::connectToDB();
    }

    public function getDB():PDO
    {
        return $this->db;
    }
}
?>