<?php
	session_start();
	include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Add Project </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
	<!-- Importing ends here -->

	<link rel="stylesheet" type="text/css" href="../../styles/admin.css">
	<script src="../../scripts/js-admin-add-project.js"> </script>
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
			<li id="home" class="side-nav-items"> <a href="Welcome.php" class="nav-link"> Home </a> </li>
			<li id="add-project" class="side-nav-items active"> <a href="AddProject.php" class="nav-link active-link"> Add Project </a> </li>
			<li id="delete-project" class="side-nav-items"> <a href="DeleteProject.php" class="nav-link"> Delete Project </a> </li>
			<li id="add-client" class="side-nav-items"> <a href="AddClient.php" class="nav-link"> Add Client </a> </li>
			<li id="add-engineer" class="side-nav-items"> <a href="AddEngineer.php" class="nav-link"> Add Engineer / Project Manager </a> </li>
			<li id="session-tracking" class="side-nav-items"> <a href="SessionTracking.php" class="nav-link"> Session Tracking </a> </li>
			<li id="complaint-status" class="side-nav-items"> <a href="ComplaintStatus.php" class="nav-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="admin"){
		?>
		<h1 class="main-heading"> Add Project </h1>
		<p class="message"></p><br/>
		<form method="post">
			<input type="text" pattern="^[a-zA-Z\s]{1,100}$" required="required" placeholder="Project" id="project-name" name="project-name"> <br/>
			<div id="dynamicInput">
          		<input type="text" pattern="^[a-zA-Z\s]{1,100}$" required="required" name="Modules[]" placeholder="Module1" id="first-input">
          		<input type="button" value="+" onClick="addInput('dynamicInput');" class="small-button">
          		<input type="button" value="-" onClick="deleteInput();" class="small-button">
     		</div>
			<input type="submit" value="Add Project" class="submit-delete-button">
		</form>

		<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';
		$flag = 0;
		$flage = 0;

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		if($conn->connect_error)
		{
			die("connection failed: ". $conn->connect_error);
		}

		if($_POST) :
			$name = $_POST["project-name"];
			$sql = "INSERT INTO project (name) VALUES ('$name')";
			
			if (mysqli_query($conn, $sql)) {
				$flag = 1;
			} 

			$sql = "SELECT id FROM project WHERE name='$name'";
			$result = $conn->query($sql);
			$ide = $result->fetch_assoc();
			$id = $ide["id"];

			$modules = $_POST["Modules"];
			
			foreach ($modules as $module)
			{
				$sql = "INSERT INTO module (name,project_id) VALUES ('$module',$id)";
				if (mysqli_query($conn, $sql)) {
			    	$flage = 1;
				}
			}

			if($flag==1 && $flage==1)
			{
				echo "<p class='create-message'> New project and corresponding modules created successfully </p>";
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
		else
		{
			echo "<p class='delete-message'> You must be logged in to see this page </p>";
		}
	?>
	</div>
	<!-- The main content ends -->
</div>
</body>
</html>	
