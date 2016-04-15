<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Complaint Status</title>
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
			<li id="review-engineer" class="side-nav-items"> <a href="ReviewEngineer.php" class="nav-link"> Review Engineer </a> </li>
			<li id="complaint-status" class="side-nav-items active"> <a href="ComplaintStatus.php" class="nav-link active-link"> ComplaintStatus </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="pmanager"){
		?>
		<h1 class="main-heading"> Complaint Status </h1>
		<form method="post">		
			<input type="submit" value="Unassigned Complaints" class="unassigned-complaints-button" name="unassigned-button">
			<input type="submit" value="All Complaints" class="all-complaints-button" name="all-complaints-button">
		</form>

		<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		if(isset($_POST['unassigned-button'])) {
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> Project Name </th>";
		echo "		<th> Description </th>";
		echo "		<th> Project ID </th>";
		echo "		<th> Module ID </th>";
		echo "		<th> Engineer ID </th>";
		echo "		<th> Status </th>";
		echo "	</tr>"; 

		$sql = "SELECT * FROM problem,project WHERE problem.project_id=project.id AND engineer_id IS NULL";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr class='invalid-row'>";
		        echo "<td>" . $row["name"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td>" . $row["status"]. "</td>";
		        echo "</tr>";
		    }
		} else {
		    echo "0 results";
		}
		}

		else if(isset($_POST['all-complaints-button']) || (!isset($_POST['unassigned-button']))) {
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> Project Name </th>";
		echo "		<th> Description </th>";
		echo "		<th> Project ID </th>";
		echo "		<th> Module ID </th>";
		echo "		<th> Engineer ID </th>";
		echo "		<th> Status </th>";
		echo "	</tr>"; 

		$sql = "SELECT * FROM problem,project WHERE problem.project_id=project.id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	if($row["engineer_id"] == NULL)
		    	{
			    	echo "<tr class='invalid-row'>";
			        echo "<td>" . $row["name"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td>" . $row["status"]. "</td> ";
			        echo "</tr>";
			    }
			    else
			    {
			    	echo "<tr class='valid-row'>";
			        echo "<td>" . $row["name"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td>" . $row["status"]. "</td>";
			        echo "</tr>";
			    }
		    }
		} else {
		    echo "0 results";
		}
		}
		$conn->close();
	?>
	</table>
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
