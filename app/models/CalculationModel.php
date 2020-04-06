<?php
class CalculationModel extends Model 
{
    private $token ="";
    private $wall;
    private $like;
    private $group;
    private $reportID = 0;
    private $userList = [];

    public function __construct() 
    {
        parent::__construct();

        if (User::isUserToken())
            $this->token = $_SESSION["token"];
        else 
            $this->goHome();
        $this->user = new User($this->token);
        $this->wall = new Wall($this->token);
        $this->group = new Group($this->token);
    }

   public function getNewReport():int
   {
    //while (true);
        $allUsers = $this->_getBestUsers();
        //$this->_saveBestUsers();
        //$this->_getPopularCommunity();
        //$this->_savePopularCommunity();
        return $this->reportID;
   } 

   private function _getBestUsers():array
   {
    $start = microtime(true);

        $idGroup = $this->_getGroupID();
        $listWallID = $this->wall->getListID($idGroup);
        $this->_createAllActiveUsers($idGroup, $listWallID);
        $this->_cropUserList();

        printTime($start);
        return [];
   }

   private function _getGroupID()
   {
        $inputID = $this->_getInputID(); 
        $inputID = "artboxoff";//temporary !!!
        $idGroup = $this->group->getID($inputID);

         if ($idGroup === 0){
             $this->_sendError("ID сообщества указано не верно", 100);
             exit;
         }
         return $idGroup;
   }

   private function _getInputID():string
   {
       $post = "";
        if(isset($_POST["idCommunity"]))
            $post = $_POST["idCommunity"];
        $id = $this->_getValidInputID($post);
            return($id);
   }

   private function _createAllActiveUsers($idGroup, $listWallID):void
   {
       $countSend = 0;
       $userList = [];
       $period = 0;

        foreach($listWallID as $key=>$id){
            $time = microtime(true);
            $actions = $this->user->getActionLists($idGroup, $listWallID[$key]);
            $this->_createActiveUsers($idGroup, $actions, $id);
            $countSend += 1;
            $period += round(microtime(true) - $time, 6);
            $this->_requestControll($countSend, $period);
        }
        //$this->_cropUserList()
   }

   private function _createActiveUsers($idGroup, $actions, $recordID):void
   {
        if(!empty([$actions["likes"]])){
            foreach($actions["likes"] as $key=>$id){
                
                if(empty($this->userList[$id])){
                    $this->userList[$id] = new App\User($id);
                    $this->userList[$id]->setActions($idGroup);
                } 
                $this->userList[$id]->addLike($recordID);
            }
        }
        if(!empty([$actions["reposts"]])){
            foreach($actions["reposts"] as $key=>$id){

                if(empty($this->userList[$id])){
                    $this->userList[$id] = new App\User($id);
                    $this->userList[$id]->setActions($idGroup);
                } 
                $this->userList[$id]->addRepost($recordID);
            }
        }
    
   }

   private function _setUserActiveScore():void
   {
       foreach($this->userList as $user){
           $user->setActiveScore();
       }
   }

   private function _cropUserList():void
   {
        usort($this->userList, 'sortByUserActive');
        $count = count($this->userList);
        if($count > 100)
        for($i = 100; $i < $count; $i++){
            unset($this->userList[$i]);
        }

   }

   private function _requestControll($countSend, &$period)//there are limits on the number of request
   {
        if($countSend % 3 == 0)
        {
            $diff = (1 - $period) * 1000000;
            $period = 0;
            usleep($diff);
        }
   }


   private function _getValidInputID($post):string
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

function sortByUserActive($user1, $user2):int
    {
        if ($user1->getActiveScore() == $user2->getActiveScore()) 
            return 0; 
        return ($user1->getActiveScore() > $user2->getActiveScore()) ? -1 : 1;
    }
?>