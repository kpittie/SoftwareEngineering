<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'cmt';

	$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	if($conn->connect_error)
	{
		die("connection failed: ". $conn->connect_error);
	}

	echo "Connected Successfully";
?>