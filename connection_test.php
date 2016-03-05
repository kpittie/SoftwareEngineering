<?php
$dbhost = '127.0.0.1:3306';
$dbuser = 'root';
$dbpass = 'varun';
$dbname="cms";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
// Create connection


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>