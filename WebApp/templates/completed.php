<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Template </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<!-- Importing ends here -->
	
	
</head>


<body>
<div id="container">	
	<!-- This is the top nav bar donot make changes here -->
	<nav id="top-nav">
		<ul id="top-nav-list">
			<li class="top-nav-item" id="logo"> <img src="../images/logo.png" alt="logo" id="logo-image"> </li> 
			<li><div id="clock">
                            <object width="200" height="60" data="timer.swf"></object>
                            </div></li>
			<li class="top-nav-item" id="logout-button"  > <a id="logout-link" href="#"> Home </a></li>
			<li class="top-nav-item" > <a id="logout-link" href="#"> About </a></li>
			<li class="top-nav-item" "> <a id="logout-link" href="#"> Logout </a> </li>
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<br><br>
			
			<li id="add-engineer" class="side-nav-items"> <a href="ongoing.php" class="nav-link"> Ongoing Problems </a> </li>
			<br>
			<li id="session-tracking" class="side-nav-items"> <a href="completed.php" class="nav-link"> Completed Problems </a> </li>
			
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<p id="content">
			<h1> Completed Problems </h1>
		</p>
	
			
	


<?php

include 'connection.php';

$query= "select * from problem where status='c'";

$result=mysqli_query($conn,$query);

echo "<table>";
echo "<th>Problem ID</th><th> Description</th>";
while($row=mysqli_fetch_assoc($result))
	{ 
       

		echo "<tr>";

	
	    
	     echo "<td>".$row['id']."</td><td>".$row['description']."</td>"; 
		   
	}
echo "</table>";

?>
</div>
</div>
</body>
</html>	
