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

	$name = $_POST["project-name"];
	$sql = "INSERT INTO project (name) VALUES ('$name')";
	
	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
	} 
	else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	$sql = "SELECT id FROM project WHERE name='$name'";
	$result = $conn->query($sql);
	$ide = $result->fetch_assoc();
	$id = $ide["id"];

	var_dump($id);
	$modules = $_POST["Modules"];
	var_dump($modules);
	
	foreach ($modules as $module)
	{
		$sql = "INSERT INTO module (name,project_id) VALUES ('$module',$id)";
		if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
		} 
		else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}	
mysqli_close($conn);
?>