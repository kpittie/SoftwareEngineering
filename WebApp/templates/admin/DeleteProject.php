<?php
	session_start();
	include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Delete Project </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
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
			<li id="home" class="side-nav-items"> <a href="Welcome.php" class="nav-link"> Home </a> </li>
			<li id="add-project" class="side-nav-items"> <a href="AddProject.php" class="nav-link"> Add Project </a> </li>
			<li id="delete-project" class="side-nav-items active"> <a href="DeleteProject.php" class="nav-link active-link"> Delete Project </a> </li>
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
			<input type="text" required="required" pattern="^[0-9]{1,10}$" placeholder="Project ID" id="project-id" name="project-id">
			<input type="submit" value="Delete" class="submit-delete-button">
		</form>

		<table>
			<tr>
				<th> ID </th>
				<th> Project Name </th>
			</tr>
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

			$sql = "SELECT * FROM PROJECT";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "</tr>";
			}
		?>
		</table>

		<div id="message">
				<?php
					if($_POST) :
							$flag = 0;
  							$id = $_POST['project-id'];
  							$sqll = "SELECT * from project";
  							$result = $conn->query($sqll);
  							while($row = $result->fetch_assoc()) {
  								if($row["id"] == $id) {
  									$flag = 1;
  									break;	
  								}
  							}
  							if($flag == 1)
  							{
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
								header ('location: DeleteProject.php');
  							}
							else
							{
								echo "<p class='delete-message'> Incorrect ID entered or the project has already been deleted </p>";
							}
						mysqli_close($conn);
					endif;
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
