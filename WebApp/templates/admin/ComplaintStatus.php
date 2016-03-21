<!DOCTYPE HTML>
<html>
<head>
	<title> Complaint Status</title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<!-- Importing ends here -->

	<link rel="stylesheet" type="text/css" href="../../styles/admin.css">
</head>

<body>
<div id="container">	
	<!-- This is the top nav bar donot make changes here -->
	<nav id="top-nav">
		<ul id="top-nav-list">
			<li class="top-nav-item" id="logo"> <img src="../../images/logo.png" alt="logo" id="logo-image"> </li>
			
			<li class="top-nav-item" id="logout-button"> <a id="logout-link" href="#"> Logout </a> </li>
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<li id="add-project" class="side-nav-items"> <a href="AddProject.html" class="nav-link"> Add Project </a> </li>
			<li id="delete-project" class="side-nav-items"> <a href="DeleteProject.html" class="nav-link"> Delete Project </a> </li>
			<li id="add-client" class="side-nav-items"> <a href="AddClient.html" class="nav-link"> Add Client </a> </li>
			<li id="add-engineer" class="side-nav-items"> <a href="AddEngineer.html" class="nav-link"> Add Engineer / Project Manager </a> </li>
			<li id="session-tracking" class="side-nav-items"> <a href="SessionTracking.html" class="nav-link"> Session Tracking </a> </li>
			<li id="complaint-status" class="side-nav-items"> <a href="ComplaintStatus.html" class="nav-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<h1 class="main-heading"> Complaint Status </h1>
		<form method="post">		
			<input type="submit" value="Unassigned Complaints" class="unassigned-complaints-button" name="unassigned-button">
		</form>

		<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		if(isset($_POST['unassigned-button'])) :
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> ID </th>";
		echo "		<th> Description </th>";
		echo "		<th> Project ID </th>";
		echo "		<th> Module ID </th>";
		echo "		<th> Engineer ID </th>";
		echo "		<th> Status </th>";
		echo "		<th> Priority </th>";
		echo "		<th> Reopenings </th>";
		echo "		<th> Timestamp </th>";
		echo "	</tr>"; 

		$sql = "SELECT * FROM problem";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr>";
		        echo "<td>" . $row["id"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td>" . $row["status"]. "</td> <td>" . $row["priority"]. "</td> <td>" . $row["reopenings"]. "</td> <td>" . $row["timestamp"]. "</td>";
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
