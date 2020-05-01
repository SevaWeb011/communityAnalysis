<?php
class CalculationModel extends Model 
{
    private $userList = [];
    private $groupList = [];
    private $idGroup;
    private $percentActivity;

    public function __construct() 
    {
        parent::__construct();
        if (!User::isUserToken())
            $this->goHome();
        session_write_close();

    }

   public function getNewReport():int
   {
    //$start = microtime(true);
    try{
        $reportID = 0;
        $bestUsers = $this->_getBestUsers();
        $groups = $this->_getPopularCommunity($bestUsers);
        $reportID = $this->_getReportID($bestUsers, $groups);
        if($reportID == 0)
            $this->_sendError("Неизвестная ошибка при анализе. Пожалуйста, свяжитесь с разработчиком");
        //printTime($start);
        return $reportID;
    }
    catch (AppExeptions $e){
        $this->_sendError("Не предвиденная ошибка. Если проблема не пройдет, обратитесь к разработчику.");
        $e->__toString();
        exit;
    }
    catch(VKExeptions $e) {
        $this->_sendError("Сбой при работе сервиса VK. Если ошибка не пройдет, обратитесь к разработчику.");
        $e->__toString();
        exit;
      }
   } 

   private function _getBestUsers():array
   {
        $idGroup = $this->_getGroupID();
        $listWallID = $this->wall->getListID($idGroup, 100);
        if(empty($listWallID)){
            $this->_sendError("Нет доступа к данному сообществу.");
            exit;
        }
        $this->_createAllActiveUsers($idGroup, $listWallID);
        $this->_cropList($this->userList, 100);
        usort($this->userList, 'sortByUserActive');
        $this->_setUserNames($this->userList);
            return $this->userList;
   }

   private function _getGroupID()
   {
        $inputID = $this->_getInputID(); 
        //$inputID = "itumor";//temporary !!!
        $this->idGroup = $this->group->getID($inputID);

         if ($this->idGroup == 0){
             $this->_sendError("ID сообщества указано не верно", 100);
             exit;
         }
         return $this->idGroup;
   }

   private function _getInputID():string
   {
       $post = "";
        if(isset($_POST["idCommunity"]))
            $post = $_POST["idCommunity"];
        if(empty($post))
            $this->_sendError("Введите ID");
        $id = $this->_getValidInputID($post);
            return($id);
   }

   private function _createAllActiveUsers($idGroup, $listWallID):void
   {
       $userList = [];
    //    $count = 0;//!!!
        foreach($listWallID as $key=>$id){
            $actions = $this->user->getActionLists($idGroup, $listWallID[$key]);
            $this->_createActiveUsers($actions, $id);
            // $count += 1;//!!!

            // if($count == 5) break;//!!!
        }
        $this->_arrayConvertToList($this->userList);
   }

   private function _createActiveUsers($actions, $recordID):void
   {
       $userList = &$this->userList;

        if(!empty($actions["likes"])){
            foreach($actions["likes"] as $key=>$id){
                
                if(empty($userList[$id]))
                    $userList[$id] = new App\User($id); 
                $userActions = $userList[$id]->getUserActive();
                $userActions->addLike($recordID);
            }
        }
        if(!empty($actions["reposts"])){
            foreach($actions["reposts"] as $key=>$id){

                if(empty($userList[$id]))
                    $userList[$id] = new App\User($id);
                    $userActions = $userList[$id]->getUserActive();
                    $userActions->addRepost($recordID);
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

   private function _arrayConvertToList(&$array):void
   {
       $count = 0;
       $list = [];

        foreach($array as $val)
        {
            $list[$count] = $val;
            $count++;
        }

        $array = $list;
   }

   private function _setUserNames(&$list):void
   {
    $listID = [];
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
        exit;
   }

   private function _getPopularCommunity($userList):array
   {
       foreach($userList as $user){
            $time = microtime(true);
            $idUser = $user->getID();
            $groups = $this->group->getUserGroup($idUser);

                if(empty($groups["error"]))
                    $this->_createGroups($groups, $idUser);
       }
        $this->_arrayConvertToList($this->groupList);
        $this->_cropList($this->groupList, 15);
        usort($this->groupList, 'sortByCountUser');
        $this->_initGroups($this->groupList);
            return $this->groupList;
   }

   private function _createGroups($groups, $idUser):void
   {
        foreach($groups as $id){
            if($id != $this->idGroup){       
                if(empty($this->groupList[$id]))
                    $this->groupList[$id] = new App\Group($id);
            
                $this->groupList[$id]->addActiveUsers($idUser);
            }
        }
   }

   private function _initGroups(&$groupsList)
   {
       if(empty($groupsList))
            throw new AppExeptions("Array Groups empty");
        $ids = $this->_getListIdGroups($groupsList);
        $data = $this->group->getGroupsData($ids);
        $i = 0;

        foreach($data as $val){
            $name = $val["name"];
            $photo = $val["photo"];
            $groupsList[$i]->setName($name);
            $groupsList[$i]->setPhoto($photo);
            $i++;
        }
        $this->_initGroupsCountSubscribers($ids, $groupsList);
   }

   private function _getListIdGroups(&$groupsList):array
   {
    foreach($groupsList as $group){
        $ids[] = $group->getID();
    }
    return $ids;
   }

   private function _initGroupsCountSubscribers($ids, &$groupsList, $offset = 0)
   {
        $count = count($ids);

        for($i = $offset; $i < $offset + 25; $i++)
        {
            if(empty($ids[$i]))
                break;
            $idsSend[] = $ids[$i]; 
        }

        $idsSend["count"] = count($idsSend);;
        $countUsers = $this->group->getCountSubscriber($idsSend);

        for($i = $offset; $i < $offset + 25; $i++)
        {
            if(empty($groupsList[$i]))
                break;
            $groupsList[$i]->setCountSubscriber($countUsers[$i - $offset]);
        }

        if($count > $offset + 25){
            $offset += 25;
            $this->_initGroupsCountSubscribers($ids, $groupsList, $offset);
        }
   }

   private function _getReportID($users, $groups):int
   {
       $report = 0;
        try{
            $this->db->beginTransaction();
            $report = $this->saveReport();
            $this->saveUsers($users, $report);
            $this->saveGroups($groups, $report);
            $this->db->commit();
        } catch ( PDOException $e ) { 
        $this->db->rollback();
        throw $e;
        } 
        return $report;
   }

   private function saveReport()
   {
        $tableName = "reports";
        $params = [
            "group_id" => $this->idGroup,
            "group_name" => $this->group->getName($this->idGroup),
            "count_wall" => 100
        ];

        $this->db->add($tableName,$params);

        $report = $this->db->lastInsertID();
        $tableName = "users_app";
        $params = [
            "user_id" => User:: getUserAppID(),
            "report_id" => $report
        ];

        $this->db->add($tableName,$params);

        return $report;
   }

   private function saveUsers($users, $report)
   {
    $tableName = "best_users";
       foreach($users as $user){
           $user->setCountActions();
           $actions = $user->getUserActive();
            $params = [
                "user_id" => $user->getID(),
                "name" => $user->getName(),
                "count_like" => $actions->getCountLike(),
                "count_comment" => $actions->getCountComment(),
                "count_repost" => $actions->getCountRepost(),
                "active_score" => $user->getActiveScore(),
                "report_id" => $report
            ];

            $this->db->add($tableName,$params);
        }
   }

   private function saveGroups($groups, $report)
   {
    $tableName = "group_list";
       foreach($groups as $group){
            $params = [
                "group_id" => $group->getID(),
                "name" => $group->getName(),
                "count_active_user" => $group->getCountActiveUsers(),
                "count_subscriber" => $group->getCountSubscriber(),
                "photo" => $group->getPhoto(),
                "report_id" => $report
            ];
            
            $this->db->add($tableName,$params);
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