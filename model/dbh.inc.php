<?php
// DB Credentials
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";
// DB Connection
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// DB Connection Error Handle
if (!$conn) {
    die("Connection Failed!: " . mysqli_connect_error());
}
