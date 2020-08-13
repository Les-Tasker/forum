<?php
include_once 'DBConn.class.php';
class DBConnHandler extends DBConn
{


    public function connectionHandler()
    {
        $dbConnHandler = $this->Connection();
        return $dbConnHandler;
    }
}