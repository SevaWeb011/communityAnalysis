<?php
class IndexModel extends Model {
    public function getUserName()
    {
        $userName = $this->_getUserNameResponse();
        if(empty($userName))
            $userName = "гость";
        return $userName;
    }

    private function _getUserNameResponse()
    {
        $userName = "";
        if(User::isUserToken()){
            $id = $_SESSION["userID"];
            $token = $_SESSION["token"];
            $user = new User($token);
            $userName = $user->getUserName($id);
        }
        return $userName;
    }
}
?>