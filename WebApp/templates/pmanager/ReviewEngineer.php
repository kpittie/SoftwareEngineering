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
		<h1 class="main-heading"> Review Engineer </h1>
		<form action= "ReviewEngineerExtd.php" method="post">
			<input type="text" placeholder="Engineer ID" name="engineer-id"> <br/>
			<input type="submit" value="Submit" class="submit-delete-button">
		</form>
	<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';
		$user = $_SESSION['user-name'];

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		$sql = "SELECT project_id FROM engineer WHERE id=$user";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$pid = $row['project_id'];

		$sql = "SELECT * FROM engineer WHERE project_id=$pid";
		$result = mysqli_query($conn,$sql);
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> Engineer ID </th>";
		echo "		<th> Project ID </th>";
		echo "		<th> Module ID </th>";
		echo "		<th> Active Complaints </th>";
		echo "		<th> Total Complaints </th>";
		echo "		<th> Status </th>";
		echo "  </tr>";

		while($row = mysqli_fetch_array($result)){
				echo "<tr>";
		        echo "<td>" . $row["id"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>". $row["number_of_complaints"]."</td><td>".$row["total_complaints"]."</td><td>".$row["status"]."</td>";
		        echo "</tr>";
		}
		echo "</table>";
	?>
	</div>
	<?php } ?>
	<!-- The main content ends -->
</div>
<script src="../../scripts/timer.js"></script>
</body>
</html>	