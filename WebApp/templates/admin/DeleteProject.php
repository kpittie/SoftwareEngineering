<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Delete Project </title>
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
			<li id="add-project" class="side-nav-items"> <a href="AddProject.php" class="nav-link"> Add Project </a> </li>
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
		<h1 class="main-heading"> Delete Project </h1>
		<form method="post">
			<input type="text" pattern="^[0-9]{1,10}$" placeholder="Project ID" id="project-id" name="project-id">
			<input type="submit" value="Delete" class="submit-delete-button">
		</form>
		<div id="message">
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
  							$id = !isset($_POST['project-id']) ? 0 : $_POST['project-id'];
							$sql = "DELETE FROM project WHERE id=$id";	
							if(mysqli_query($conn, $sql))
							{
								echo "<p class='delete-message'> The project was deleted </p>";
							}
							$sql = "DELETE FROM module WHERE project_id=$id";
							if(mysqli_query($conn, $sql))
							{
								echo "<p class='delete-message'> The associated modules have been deleted </p>";
							}
						mysqli_close($conn);
					endif;
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
