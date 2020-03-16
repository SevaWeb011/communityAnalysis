<?php
class User extends Request
{
    public function getUserName($id):string
    {
        $name = "";
        $userData = $this->_getUserData($id);
        $userArray = json_decode($userData, true);
        $name = $userArray["response"][0]["first_name"];
        return $name;
    }

    private function _getUserData($id):string
    {
        $method = "users.get";
        $request_params = array(
            "user_ids" => $id,
            "name_case" => "nom", 
            'v' => '5.103',
            'access_token' => $this->token
            );
        $get_params = http_build_query($request_params);

        $request = self::PATH_SERVICE . "/$method?" .$get_params;
         $request = trim($request);
        $response = file_get_contents($request);
        return $response;
    }
}
?>