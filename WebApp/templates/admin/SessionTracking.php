<?php
	session_start();
	include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Session Tracking </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
	<!-- Importing ends here -->
	<script>
		function trig(pid) {
		    if (pid == "") {
		        document.getElementById("engineer-status").innerHTML = "";
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
		                document.getElementById("engineer-status").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","fetch_status.php?q="+pid,true);
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
			<li id="add-engineer" class="side-nav-items"> <a href="AddEngineer.php" class="nav-link"> Add Engineer / Project Manager </a> </li>
			<li id="session-tracking" class="side-nav-items active"> <a href="SessionTracking.php" class="nav-link active-link"> Session Tracking </a> </li>
			<li id="complaint-status" class="side-nav-items"> <a href="ComplaintStatus.php" class="nav-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="admin"){
		?>
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

                 	echo "<select name='engineer-id' id='engineer-id' onchange='trig(this.value);'>"; 
                 	echo '<option value="" selected="true" style="display:none;">Select Engineer ID</option>';  
		            while ($row = mysqli_fetch_array($result)) {
		            echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
		            }      

		           	echo '</select>';
		           	$conn->close();
                ?>
 		<br/>
 		<div id="engineer-status"></div> 			
		</form>
	<?php
		}
		else
		{
			echo "<p class='delete-message'> You must be logged in to see this page </p>";
		}
	?>
	</div>
	<!-- The main content ends -->
</div>
<script src="../../scripts/timer.js"></script>
</body>
</html>	
