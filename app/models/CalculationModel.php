<?php
class CalculationModel extends Model 
{
    private $token ="";
    private $wall;
    private $like;
    private $group;
    private $reportID = 0;

    public function __construct() 
    {
        parent::__construct();

        if (User::isUserToken())
            $this->token = $_SESSION["token"];
        else 
            $this->goHome();
        $this->like = new Like($this->token);
        $this->wall = new Wall($this->token);
        $this->group = new Group($this->token);
    }

   public function getNewReport():int
   {
    //while (true);
        $allUsers = $this->_getAllActiveUsers();
        //$topUsers = $this->getBestUsers($allUsers);
        //$this->_saveTopUsers();
        //$this->_getPopularCommunity();
        //$this->_savePopularCommunity();
        return $this->reportID;
   } 

   private function _getAllActiveUsers():array
   {
    $start = microtime(true);
         $inputID = $this->_getInputID(); 
         $inputID = "spo_lider";//temporary
         $idGroup = $this->group->getID($inputID);
         if ($idGroup === 0){
             $this->_sendError("ID сообщества указано не верно", 100);
             exit;
         }
        
         $listWallID = $this->wall->getListID($idGroup);
         $listLike = $this->like->getLikeList($idGroup, $listWallID);
        printTime($start);
        return [];
   }

   private function _getInputID():string
   {
        if(isset($_POST["idCommunity"]))
            $post = $_POST["idCommunity"];
        $id = $this->_isValidInputID($post);
            return($id);
   }

   private function _isValidInputID($post):string
   {
        if(strlen($post) < 150){
            $id = trim(htmlspecialchars($post));
            return $id;
        } else{
            $this->_sendError("Ошибка: слишком много символов введено");
            exit;
        }
   }

   private function _sendError($msg, $code = 0):void
   {
        $err["error"]["text"] = $msg;
        $err["error"]["code"] = $code;
        $err = json_encode($err);
        echo $err; 
   }

}
?>