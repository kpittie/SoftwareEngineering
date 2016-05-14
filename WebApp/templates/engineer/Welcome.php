<?php
	session_start();
	include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Welcome</title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
	<!-- Importing ends here -->

	<link rel="stylesheet" type="text/css" href="../../styles/admin.css">
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
			<li id="home" class="side-nav-items active"> <a href="Welcome.php" class="nav-link active-link"> Home </a> </li>
			<li id="ongoing-problems" class="side-nav-items"> <a href="ongoing.php" class="nav-link"> Ongoing Problems </a> </li>
			<li id="complete-problems" class="side-nav-items"> <a href="complete.php" class="nav-link"> Completed Problems </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="engineer"){
		?>
		<h1 class="main-heading"> Welcome Engineer ID: <?php echo $_SESSION['user-name']; ?> </h1>
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
