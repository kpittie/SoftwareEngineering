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
		<h1 class="main-heading"> Add Engineer / Project Manager </h1>
		<form method="post">
				<?php

					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '';
					$dbname = 'cmt';
					$id = $_POST['project-name'];                         
		            $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		            $sql = "select * from  project";         
		            $result = $conn->query($sql);

		            echo "<select name='project-name' id='project-name'>"; 

		            while ($row = mysqli_fetch_array($result)) 
		            {
			            if($row['id']==$id)
			            {
			            	echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			            }
			            else
			            {
			            	echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';		            	
			            }
					}      
		           	echo '</select>';
		           	echo '<br/>';

		           	$sql = "select * from  module where project_id=$id";         
		            $result = $conn->query($sql);
                 	echo "<select name='module-name' id='module-name'>";
                 	while ($row = mysqli_fetch_array($result)) {
		            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		            }      

		           	echo '</select>';
		           	$conn->close();
                ?>
				</br>
			<input type="text" placeholder="Engineer ID" id="engineer-id" name="engineer-id"> <br/>
			<input type="password" placeholder="Password" id="password" name="password"> <br/>
			<label id="radio-label"> Project Manager: <input type="radio" class="radio-input" name="pmanager" value="y">Yes <input type="radio" name="pmanager" class="radio-input" value="n">No </label> <br/> 			
			<input type="submit" value="Add Client" class="submit-delete-button">
		</form>
	</div>
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

		if(isset($_POST['engineer-id'])) :
			$pid = $_POST["project-name"];
			$mid = $_POST["module-name"];
			$id = $_POST["engineer-id"];
			$pass = $_POST["password"];
			$pmanager = $_POST["pmanager"];

			$sql = "INSERT INTO engineer (id,password,project_id,module_id,project_manager) VALUES ('$id','$pass','$pid','$mid','$pmanager')";
			
			if (mysqli_query($conn, $sql)) {
		    echo "<p class='create-message'> New engineer created successfully </p>";
			} 

			if($pmanager == 'y')
			{
			$sql = "UPDATE project SET manager_id = $id WHERE id = $pid";
				if (mysqli_query($conn, $sql)) 
				{
			    	echo "<p class='create-message'> New engineer created successfully </p>";
				}
			}
			endif;
		mysqli_close($conn);
	?>
	<!-- The main content ends -->
</div>
</body>
</html>	
