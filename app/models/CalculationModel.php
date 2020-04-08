<?php
class CalculationModel extends Model 
{
    private $userList = [];
    private $groupList = [];

    public function __construct() 
    {
        parent::__construct();

    }

   public function getNewReport():int
   {
    $start = microtime(true);
    //while (true);
        $reportID = 0;
        $bestUsers = $this->_getBestUsers();
        $groups = $this->_getPopularCommunity($bestUsers);
        var_dump($groups);
        //$this->_saveBestUsers();
        //$this->_savePopularCommunity();
        printTime($start);
        return $reportID;
   } 

   private function _getBestUsers():array
   {
        $idGroup = $this->_getGroupID();
        $listWallID = $this->wall->getListID($idGroup);
        $this->_createAllActiveUsers($idGroup, $listWallID);
        $this->_cropList($this->userList, 100);
        usort($this->userList, 'sortByUserActive');
        $this->_setUserNames($this->userList);
        return $this->userList;
   }

   private function _getGroupID()
   {
        $inputID = $this->_getInputID(); 
        $inputID = "spo_lider";//temporary !!!
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
            $this->_createActiveUsers($actions, $id);
            $countSend += 1;
            if($countSend == 50) break;//!!!
            $period += round(microtime(true) - $time, 6);
            $this->_requestControll($countSend, $period);
        }
   }

   private function _createActiveUsers($actions, $recordID):void
   {
       //var_dump($actions);
        if(!empty($actions["likes"])){
            foreach($actions["likes"] as $key=>$id){
                
                if(empty($this->userList[$id]))
                    $this->userList[$id] = new App\User($id); 
                $this->userList[$id]->addLike($recordID);
            }
        }
        if(!empty($actions["reposts"])){
            foreach($actions["reposts"] as $key=>$id){

                if(empty($this->userList[$id]))
                    $this->userList[$id] = new App\User($id);
                $this->userList[$id]->addRepost($recordID);
            }
        }
    $this->_setUsersActiveScore($this->userList);
   }

   private function _setUsersActiveScore(&$list):void
   {
       foreach($list as $user){
           $user->setActiveScore();
       }
   }

   private function _setUserNames(&$list):void
   {
       sleep(1);
        foreach($list as $user){
            $id = $user->getID();
            $listID[] = $id;
        }
        $fullNames = $this->user->getUserFullName($listID);
        foreach($list as $user){
            $id = $user->getID();
            $name = $fullNames[$id];
            $user->setName($name);
        }
   }

   private function _cropList(&$list, $size = 100):void
   {
        $count = count($list);
        if($count > $size)
        for($i = $size; $i < $count; $i++){
            unset($list[$i]);
        }

   }

   private function _requestControll($countSend, &$period)//there are limits on the number of request
   {
        if($countSend % 3 == 0)
        {
            $diff = (1.1 - $period) * 1000000;
            $period = 0;
            if($diff > 0)
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

   private function _getPopularCommunity($userList):array
   {
        sleep(1);
        $countSend = 3;
        $period = 0;

       foreach($userList as $user){
            $time = microtime(true);
            $idUser = $user->getID();
            $groups = $this->group->getUserGroup($idUser);
                if(empty($groups["error"]))
                    $this->_createGroups($groups, $idUser);
            $period += round(microtime(true) - $time, 6);
            $countSend += 1;
            $this->_requestControll($countSend, $period);
       }
        $this->_cropList($this->groupList, 30);
        usort($this->groupList, 'sortByCountUser');
        return $this->groupList;
   }

   private function _createGroups($groups, $idUser):void
   {
        foreach($groups as $id){
            if(empty($this->groupList[$id]))
                $this->groupList[$id] = new App\Group($id);
        
            $this->groupList[$id]->addActiveUsers($idUser);
        }
   }

}

function sortByUserActive($user1, $user2):int
    {
        if ($user1->getActiveScore() == $user2->getActiveScore()) 
            return 0; 
        return ($user1->getActiveScore() > $user2->getActiveScore()) ? -1 : 1;
    }

function sortByCountUser($group1, $group2):int
    {
        if ($group1->getCountActiveUsers() == $group2->getCountActiveUsers()) 
            return 0; 
        return ($group1->getCountActiveUsers() > $group2->getCountActiveUsers()) ? -1 : 1;
    }
?>