<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Template </title>
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
		
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<h1> Administrator Login </h1>
		<form  method="post">
			<input type="text" placeholder="Admin ID" name="admin"> <br/>
			<input type="password" placeholder="Password" name="pass"> <br/>
			<input type="submit" value="Sign In" class="submit-delete-button">
		</form>
		<?php
			if(isset($_GET['logout'])){
				session_unset();
				session_destroy();
				header("Location: Login.php");
			}
		?>
	</div>
	<?php   
	    $dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';
		$flag=0;

	    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	    if($_POST) :
	    $pass=$_POST['pass'];
	    $name=$_POST['admin'];
	    $sqll = "select id from admin";
	    $result_id = $conn->query($sqll);
	    while ($row_id = mysqli_fetch_array($result_id))
	    {
	    	if($row_id['id']==$name)
	    	{
	    		$flag = 1;
				$sql="select password from admin where id='$name'";
	    		$result = $conn->query($sql);
	    		$row = mysqli_fetch_array($result);
	    			if (strcmp($pass,$row['name'])) {
	    				$_SESSION['user-name'] = $name;
	    				header("Location: Welcome.php");
	    			}
	    			else {
	    				echo "<p class='delete-message'>Invalid Password</p>";
	    			}
	    	}
	    }
	    if($flag == 0)
	    {
	    	echo "<p class='delete-message'>Invalid ID</p>";
	    }
	    endif;
	    $conn->close();	
	?>
	<!-- The main content ends -->
</div>
</body>
</html>	