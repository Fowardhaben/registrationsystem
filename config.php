<?php
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "MorningClassDB2";
$dbname = "TestDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

// sql to create table
// sql to create table
//$sql = "CREATE TABLE users (
//id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//username VARCHAR(30) NOT NULL,
//email VARCHAR(30) NOT NULL,
//password VARCHAR(50),
//reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//)";


//if (mysqli_query($conn, $sql)) {
//    echo "Table MyGuests created successfully";
//} else {
//    echo "Error creating table: " . mysqli_error($conn);
//}
?>