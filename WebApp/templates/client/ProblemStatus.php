<!DOCTYPE HTML>
<html>
<head>
	<title>Complaint Status </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
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
			<li id="add-problem" class="side-nav-items"> <a href="RegisterProblem.php" class="nav-link"> Register Complaint</a> </li>
			<li id="cancel-problem" class="side-nav-items"> <a href="CancelProblem.php" class="nav-link"> Cancel Complaint </a> </li>
			<li id="reopen problem" class="side-nav-items"> <a href="ReopenProblem.php" class="nav-link"> Reopen Complaint </a> </li>
			<li id="problem status" class="side-nav-items"> <a href="ProblemStatus.php" class="nav-link"> Complaint Status </a> </li>

		</ul>
	</aside>
	<!-- Side bar ends here -->
	<div id="main">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	Enter the problem id:
	<input type="text" name="pid"/> <br/>
	<input type="submit" value="Search">
	</form>
	<?php
if($_POST):
 $conn = mysqli_connect("localhost","root","","cmt");
 $id=$_POST['pid'];
 $query = "select * from problem where id = $id";
 $result = mysqli_query($conn,$query);
 if (mysqli_num_rows($result)==1)
 {
 while($row= mysqli_fetch_assoc($result))
	{ 
		echo "<table>";
			echo "<tr>";
				echo "<td> Project Id: </td>";
				echo "<td> Engineer Id: </td>";
				echo "<td> Time-stamp Id: </td>";
				echo "<td> Status: </td>";
				echo "<td> Priority: </td>";
				echo "<td> Reopening: </td>";
			echo "</tr>";
			echo "<tr>";
				echo"<td>". $row['project_id']."</td>";
				echo"<td>". $row['engineer_id']."</td>";
				echo"<td>". $row['timestamp']."</td>";
				echo"<td>". $row['status']."</td>";
				echo"<td>". $row['priority']."</td>";
				echo"<td>". $row['reopenings']."</td>";
			echo"</tr>";
		echo"</table>";
	}
	}
 else
	{
	echo "<b>Sorry no such record found!!</b>";
	}
endif;
	?>	
	</div>

	<!-- This is the section where you'll add the main content of the page -->

	
	<!-- The main content ends -->	

	</div>
</body>
</html>	