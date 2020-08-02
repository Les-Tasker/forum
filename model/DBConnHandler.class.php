<?php
include_once 'DBConn.class.php';
class DBConnHandler extends DBConn
{


    public function Connection_Handler()
    {
        $DBConnHandler = $this->Connection();
        return $DBConnHandler;
    }
}