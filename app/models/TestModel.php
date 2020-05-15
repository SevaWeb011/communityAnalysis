<?php
class TestModel extends Model {

  public function __construct() 
  {
      parent::__construct();
      if (!User::isUserToken())
          $this->goHome();
      session_write_close();

  }

  public function run():void
  {
      echo 1;
  }
}
?>