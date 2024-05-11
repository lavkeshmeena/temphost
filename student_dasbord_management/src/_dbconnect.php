

<?php
$server = "127.0.0.1";
$username = "root";
$password = "@i!yaKizu";
$database = "student_man_sys";
// $database = "user_1s";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    
    die("Error". mysqli_connect_error());
}
// else{
//     echo "success";
// }
?>


