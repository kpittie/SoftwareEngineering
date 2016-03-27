<!DOCTYPE HTML>
<html>
<head>
	<title> Session Tracking </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<!-- Importing ends here -->
</head>

<body>
<div id="container">	
	<!-- This is the top nav bar donot make changes here -->
	<nav id="top-nav">
		<ul id="top-nav-list">
			<li class="top-nav-item" id="logo"> <img src="../../images/logo.png" alt="logo" id="logo-image"> </li> 
			
			<li class="top-nav-item" id="logout-button"> <a id="logout-link" href="login.html"> Logout </a> </li>
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<li id="add-project" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/AddProject.php" class="nav-link"> Add Project </a> </li>
			<li id="delete-project" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/DeleteProject.php" class="nav-link"> Delete Project </a> </li>
			<li id="add-client" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/AddClient.php" class="nav-link"> Add Client </a> </li>
			<li id="add-engineer" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/AddEngineer.php" class="nav-link"> Add Engineer / Project Manager </a> </li>
			<li id="session-tracking" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/SessionTracking.php" class="nav-link"> Session Tracking </a> </li>
			<li id="complaint-status" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/ComplaintStatus.php" class="nav-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<h1 class="main-heading"> Session Tracking </h1>
		<form method="post">
				<?php

					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '';
					$dbname = 'cmt';                           
		              $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		              $sql = "select * from  engineer";         
		              $result = $conn->query($sql);


                 	echo "<select name='engineer-id' id='engineer-id'>"; 

		            while ($row = mysqli_fetch_array($result)) {
		            echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
		            }      

		           	echo '</select>';
		           	$conn->close();
                ?>
 <br/> 			
		<input type="submit" value="Show" class="submit-delete-button" name="show-button">
		</form>
		<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		if(isset($_POST['show-button'])) :
		$engineer_id = $_POST['engineer-id'];
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> ID </th>";
		echo "		<th> Project ID </th>";
		echo "		<th> Module ID </th>";
		echo "		<th> Number of Complaints </th>";
		echo "		<th> Project Manager </th>";
		echo "	</tr>"; 

		$sql = "SELECT * FROM engineer WHERE id=$engineer_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr>";
		        echo "<td>" . $row["id"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["number_of_complaints"]. "</td> <td>" . $row["project_manager"]. "</td>";
		        echo "</tr>";
		    }
		} else {
		    echo "0 results";
		}
		endif;
		$conn->close();
	?>
	</table>
	</div>
	<!-- The main content ends -->
</div>
</body>
</html>	
