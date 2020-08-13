<?php
include_once 'DBConn.class.php';
class DBConnHandler extends DBConn
{


    public function connectionHandler()
    {
        $DBConnHandler = $this->Connection();
        return $DBConnHandler;
    }
}