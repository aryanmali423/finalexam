<?php
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "id21206275_exam_commitee(2)";
//$table="llogin";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
}
?>