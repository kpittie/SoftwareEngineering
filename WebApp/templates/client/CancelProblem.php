<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Cancel Problem </title>
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
            <li id="register-problem" class="side-nav-items"> <a href="RegisterProblem.php" class="nav-link"> Register Problem </a> </li>
            <li id="cancel-problem" class="side-nav-items"> <a href="CancelProblem.php" class="nav-link"> Cancel Problem </a> </li>
            <li id="reopen-problem" class="side-nav-items"> <a href="ReopenProblem.php" class="nav-link"> Reopen Problem </a> </li>
            <li id="problem-status" class="side-nav-items"> <a href="ProblemStatus.php" class="nav-link"> Problem Status </a> </li>
        </ul>
    </aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="client"){
		?>
		<h1 class="main-heading"> Delete Project </h1>
		<form method="post">
			<input type="text" required="required" pattern="^[0-9]{1,10}$" placeholder="Problem ID" id="problem-id" name="problem-id">
			<input type="submit" value="Delete" class="submit-delete-button">
		</form>

		<table>
			<tr>
				<th> ID </th>
				<th> Description </th>
				<th> Status </th>
				<th> Start Date </th>
			</tr>
		<?php
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '';
			$dbname = 'cmt';
			$username = $_SESSION['user-name'];

			$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

			if($conn->connect_error)
			{
				die("connection failed: ". $conn->connect_error);
			}

			$sql = "SELECT problem.id,problem.description,problem.status,problem.timestamp FROM problem inner join project on problem.project_id=project.id where project.client_id=$username";
			$result = $conn->query($sql);
			while($row = $result->	fetch_assoc())
			{
				echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['description']."</td>";
				echo "<td>".$row['status']."</td>";
				echo "<td>".$row['timestamp']."</td>";
				echo "</tr>";
			}
		?>
		</table>

		<div id="message">
				<?php
					if($_POST) :
							$flag = 0;
  							$id = $_POST['problem-id'];
  							$sqll = "SELECT problem.id,problem.description,problem.status,problem.timestamp FROM problem inner join project on problem.project_id=project.id where project.client_id=$username";
  							$result = $conn->query($sqll);
  							while($row = $result->fetch_assoc()) {
  								if($row["id"] == $id) {
  									$flag = 1;
  									break;	
  								}
  							}
  							if($flag == 1)
  							{
	  							$sql = "DELETE FROM problem WHERE id=$id";	
								if(mysqli_query($conn, $sql))
								{
									echo "<p class='delete-message'> The problem was deleted </p>";
								}
								header('location:CancelProblem.php');
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
