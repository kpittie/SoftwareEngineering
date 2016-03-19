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

	$id = $_POST["project-id"];
	$sql = "DELETE FROM project WHERE id=$id";	
	if (mysqli_query($conn, $sql)) {
    echo "Deleted successfully";
	} 
	else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	$sql = "DELETE FROM module WHERE project_id=$id";
	if (mysqli_query($conn, $sql)) {
    echo "Deleted successfully";
	} 
	else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
mysqli_close($conn);
?>