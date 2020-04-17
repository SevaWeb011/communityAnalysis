<?php
class ReportsModel extends Model {
    private $userID;
    public function __construct() 
    {
        parent::__construct();
        if (!User::isUserToken())
            $this->goHome();
        $this->userID = User::getUserAppID();
    }

    public function getReports():array
    {
        $reportsList = $this->_getReportList();
        $reports = $this->_getReportFromDB($reportsList);

        return $reports;
    }

    private function _getReportList()
    {
        $sql = "SELECT `report_id` FROM `users_app` WHERE `user_id` = $this->userID;";
        $data = $this->db->row($sql);
        $reports  = $this->_convertDataToReportList($data);
        
        return $reports;
    }

    private function _convertDataToReportList($data):array
    {
        $result = [];

        foreach($data as $val){
            $result[] = $val["report_id"];
        }
        return $result;
    }

    private function _getReportFromDB($reports):array
    {   
        $result = [];
        $sql = "SELECT `group_id`, `group_name`, `date_analysis`, `count_wall` FROM `reports` WHERE id = :report_id";
        foreach($reports as $report){
            $params["report_id"] = $report;
            $data = $this->db->row($sql, $params);
            $result[$report] = $data[0];
        }
        return $result;
    }

    public function getGroups():array
    {
        $groups = [];
        $report = $this->_getPostReport();
        if($this->_haveAccessToReport($report))
            $groups = $this->_getGroupsFromDB($report);
        return $groups;
    }

    private function _getPostReport():int
    {
        $post = 0;
        if(!empty($_POST["report"]) && is_numeric($_POST["report"]))
            $post = trim($_POST["report"]) + 0;
                if(is_int($post) && $post > 0)       
        return $post;
    }

    private function _haveAccessToReport($report):bool
    {
        $listAccess = $this->_getReportList();
        if(in_array($report, $listAccess))
            return true;
        else
            return false;
    }

    private function _getGroupsFromDB($report):array
    {
        $sql = "SELECT `group_id`, `name`, `count_active_user`, `count_subscriber`, `photo` FROM `group_list` WHERE `report_id` = $report";
            $data = $this->db->row($sql);
            $result = $data;
        return $result;
    }

    public function getUsers():array
    {
        $users = [];
        $report = $this->_getPostReport();

        if($this->_haveAccessToReport($report))
            $users = $this->_getUsersFromDB($report);
        return $users;
    }

    private function _getUsersFromDB($report)
    {
        $sql = "SELECT `user_id`, `name`, `count_like`, `count_repost`, `active_score` FROM `best_users` WHERE `report_id` = $report";
            $data = $this->db->row($sql);
            $result = $data;
        return $result;
    } 
}
?>