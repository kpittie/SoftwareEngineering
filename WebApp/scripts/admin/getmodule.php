<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'cmt';
	$pname = $_REQUEST["q"];
           
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    $sql = "SELECT * FROM module WHERE project_id = $pname";
  	$result = $conn->query($sql); 
		while ($row = mysqli_fetch_array($result)) {
			echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
     }      

		echo '</select>';
	$conn->close();
?>