<?php
	session_start();
	include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Add Engineer </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
	<!-- Importing ends here -->

	<script>
		function trig(pid) {
		    if (pid == "") {
		        document.getElementById("module-name").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("additional-tech").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","fetch_modules.php?q="+pid,true);
		        xmlhttp.send();
		    }
		}
	</script>
</head>

<body>
<div id="container">	
	<!-- This is the top nav bar donot make changes here -->
	<nav id="top-nav">
		<ul id="top-nav-list">
			<li class="top-nav-item" id="logo"> <img src="../../images/logo.png" alt="logo" id="logo-image"> </li> 
			<li class="top-nav-item" id="digital-clock"> <div id="clockDisplay" class="clockStyle"> </div> </li>
			<li class="top-nav-item" id="logout-button"> <a id="logout-link" href="Login.php?logout=1"> Logout </a> </li>
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<li id="home" class="side-nav-items"> <a href="Welcome.php" class="nav-link"> Home </a> </li>
			<li id="add-project" class="side-nav-items"> <a href="AddProject.php" class="nav-link"> Add Project </a> </li>
			<li id="delete-project" class="side-nav-items"> <a href="DeleteProject.php" class="nav-link"> Delete Project </a> </li>
			<li id="add-client" class="side-nav-items"> <a href="AddClient.php" class="nav-link"> Add Client </a> </li>
			<li id="add-engineer" class="side-nav-items active"> <a href="AddEngineer.php" class="nav-link active-link"> Add Engineer / Project Manager </a> </li>
			<li id="session-tracking" class="side-nav-items"> <a href="SessionTracking.php" class="nav-link"> Session Tracking </a> </li>
			<li id="complaint-status" class="side-nav-items"> <a href="ComplaintStatus.php" class="nav-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="admin") {
		?>
		<h1 class="main-heading"> Add Engineer / Project Manager </h1>
		<form method="post" action="">
			<input type="text" required="required" pattern="^[0-9]{1,10}$" placeholder="Engineer ID" id="engineer-id" name="engineer-id"> <br/>
			<input type="password" required="required" placeholder="Password" id="password" name="password"> <br/>			
			<select required="required" name="project-name" id="project-name" onchange="trig(this.value);"> 
				<option value="" selected="true" style="display:none;">Select project</option>
				<?php

					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '';
					$dbname = 'cmt';                           
		              $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		              $sql = "select * from  project";         
		              $result = $conn->query($sql);
		            while ($row = mysqli_fetch_array($result)) {
		            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		            }
				    echo '</select>';
		            $conn->close();
                ?>
				
				</br>

			<div id="additional-tech" name="additional-tech">
			</div> <br/>			
			<input type="submit" value="Add Engineer" class="submit-delete-button">
		</form>
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
			$flag = 0;
			$flage = 0;
			$encrypted_pass = crypt($pass, '$2a$'.$id);

			$sql = "INSERT INTO engineer (id,password,project_id,module_id,project_manager) VALUES ('$id','$encrypted_pass','$pid','$mid','$pmanager')";
			
			if (mysqli_query($conn, $sql)) {
		    	$flag = 1;
			} 

			if($pmanager == 'y')
			{
			$sql = "UPDATE project SET manager_id = $id WHERE id = $pid";
				if (mysqli_query($conn, $sql)) 
				{
			    	$flage = 1;
				}
			}

			if($flag==1 && $flage==1)
			{
				echo "<p class='create-message'> New engineer created successfully </p>";
			}
			else if($flag==1)
			{
				echo "<p class='create-message'> New engineer created successfully </p>";
			}
			else
			{
				echo "<p class='delete-message'> Failed </p>";
			}
			endif;
		mysqli_close($conn);
	?>
	<?php
	 }
	 else {
	 	echo "<p class='delete-message'> You must be logged in to see this page </p>";
	 }
	?>
	</div>
	<!-- The main content ends -->
</div>
<script src="../../scripts/timer.js"></script>
</body>
</html>	
