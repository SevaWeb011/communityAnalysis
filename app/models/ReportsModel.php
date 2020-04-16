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
        $reports = $this->_addDataReports($reportsList);

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

    private function _addDataReports($reports):array
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

        return [];
    }
}
?>