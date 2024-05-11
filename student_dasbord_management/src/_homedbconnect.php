<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "@i!yaKizu";
$dbname = "student_man_sys";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn){
    
    die("Error". mysqli_connect_error());
}
else{
    echo "success";
}
?>