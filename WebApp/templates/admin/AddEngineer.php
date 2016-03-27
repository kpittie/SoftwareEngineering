<!DOCTYPE HTML>
<html>
<head>
	<title> Add Engineer </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<!-- Importing ends here -->

	<script>
		function trig(val) {
 			var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("project-name").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "getmodule.php?q=" + val, true);
        xmlhttp.send();		
    }
	</script>
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
		<h1 class="main-heading"> Add Engineer / Project Manager </h1>
		<form method="post" action="AddEngineerExtd.php">
				<?php

					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '';
					$dbname = 'cmt';                           
		              $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		              $sql = "select * from  project";         
		              $result = $conn->query($sql);


                 	echo "<select name='project-name' id='project-name'>"; 

		            while ($row = mysqli_fetch_array($result)) {
		            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		            }      

		           	echo '</select>';
		           	$conn->close();
                ?>
				</br>
			<input type="submit" value="Project Select" class="submit-delete-button">
		</form>
	</div>
	<!-- The main content ends -->
</div>
</body>
</html>	
