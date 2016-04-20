<?php
 session_start();
 include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Review Engineer </title>
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
			<li class="top-nav-item" id="digital-clock"> <div id="clockDisplay" class="clockStyle"> </div> </li>
			<li class="top-nav-item" id="logout-button"> <a id="logout-link" href="Login.php?logout=1"> Logout </a> </li>
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<li id="home" class="side-nav-items"> <a href="Welcome.php" class="nav-link"> Home </a> </li>
			<li id="review-engineer" class="side-nav-items active"> <a href="ReviewEngineer.php" class="nav-link active-link"> Review Engineer </a> </li>
			<li id="problem-status" class="side-nav-items"> <a href="ComplaintStatus.php" class="nav-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name'])&& $_SESSION['user']=="pmanager"){
		?>
		<h4 class="main-heading"> The details of the selected Engineer are: </h4>
		
		<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$eng_id = $_POST['engineer-id'];
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> Problem ID </th>";
		echo "		<th> No. of hours worked on problem </th>";
		echo "		<th> Problem Status </th>";
		echo "  </tr>";
	

		$sql = "SELECT * FROM problem WHERE engineer_id = $eng_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	echo "<tr>";
		        echo "<td>" . $row["engineer_id"]. "</td> <td>" . $row["number_of_hours"]. "</td> <td>" . $row["status"]. "</td>";
		        echo "</tr>";
		    }
		} else {
		    echo "0 results";
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
<script src="../../scripts/timer.js"></script>
</body>
</html>	
