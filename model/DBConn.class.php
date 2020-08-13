<?php
class DBConn
{
    private $dbhost;
    private $dbuser;
    private $dbpassword;
    private $dbname;

    protected function Connection()
    {
        $this->dbhost = "localhost";
        $this->dbuser = "root";
        $this->dbpassword = "";
        $this->dbname = "loginsystem";
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);

        if (!$conn) {
            mysqli_connect_error();
        } else {

            return $conn;
        }
    }
}
class DBConnHandler extends DBConn
{


    public function connectionHandler()
    {
        $dbConnHandler = $this->Connection();
        return $dbConnHandler;
    }
}