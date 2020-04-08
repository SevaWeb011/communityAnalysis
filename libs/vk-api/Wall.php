<?php
class Wall extends Request
{
    public function getListID($id, $maxCountWall = 100):array
    {
        $ScriptVK = "listWall";
        $replaces = [
            '$maxCountWall' => $maxCountWall,
            '$ownerID' => "-".$id,
            '$version' => self::VERSION_API
        ];

        $code = $this->_initScriptVK($ScriptVK, $replaces);
        return $this->_sendExecute($code);
    }
}
?>