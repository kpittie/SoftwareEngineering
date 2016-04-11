<?php
 session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Add Client </title>
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
			
			<li class="top-nav-item" id="logout-button"> <a id="logout-link" href="login.php?logout=1"> Logout </a> </li>
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
		<?php
			if(isset($_SESSION['user-name'])){
		?>
		<h1 class="main-heading"> Add Client </h1>
		<form method="post">
			<input type="text" placeholder="User ID" name="user-id"> <br/>
			<input type="text" placeholder="User Name" name="user-name"> <br/>
			<input type="password" placeholder="Password" name="pass"> <br/>
				<?php
					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = '';
					$dbname = 'cmt';

	                $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	                $sql = "select * from  project";         
	                $result = $conn->query($sql);
						echo "<select name='project-name'>"; 
					while ($row = mysqli_fetch_array($result)) {
	             		echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
	                }      

	               	echo '</select>';
					$conn->close();
				?>
            </br>
			<input type="submit" value="Add Client" class="submit-delete-button">
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

			if($_POST) :
				$id = $_POST['user-id'];
				$pass = $_POST['pass'];
				$name = $_POST['user-name'];
				$pname = $_POST['project-name'];

				$sql = "INSERT INTO user (id,name,password) VALUES ($id,'$name','$pass')";

				if (mysqli_query($conn, $sql)) {
		    		echo "<p class='create-message'> New client created successfully </p>";
				}

				else {
					echo "DIE MOTHERFUCKER!";
				}

				$sql = "UPDATE project SET client_id=$id WHERE name='$pname'";

				if(mysqli_query($conn, $sql)) {
					echo "<p class='create-message'> New project client created successfully </p>";
				}
				else {
					echo "DIE MOTHERFUCKER";
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
</body>
</html>	
