<?php
	session_start();
	$_SESSION['timestamp'] = time();
	include '../../scripts/timeout.php';
	if(isset($_SESSION['user-name'])) {
		if($_SESSION['user']=="pmanager")
		{
			header("location: Welcome.php");			
		}
		else {
			if($_SESSION['user']=="client")
			{
				header("location: ../client/Welcome.php");
			}
			else if($_SESSION['user']=="engineer")
			{
				header("location: ../engineer/Welcome.php");
			}
			else
			{
				header("location: ../admin/Welcome.php");
			}
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Project Manager Login </title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
	<!-- Importing ends here -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../Plugins/captcha/jquery.realperson.css"> 
	<script type="text/javascript" src="../../Plugins/captcha/jquery.plugin.js"></script> 
	<script type="text/javascript" src="../../Plugins/captcha/jquery.realperson.js"></script>
<script>
$(document).ready(function() {
	$('#real-person').realperson({chars: $.realperson.alphanumeric});	
});
</script>

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
	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<li id="home" class="side-nav-items"> <a href="../index.php" class="nav-link"> Home </a> </li>
			<li id="admin" class="side-nav-items"> <a href="../admin/Login.php" class="nav-link"> Administrator </a> </li>
			<li id="client" class="side-nav-items"> <a href="../client/Login.php" class="nav-link"> Client </a> </li>
			<li id="engineer" class="side-nav-items"> <a href="../engineer/Login.php" class="nav-link"> Engineer </a> </li>
			<li id="pmanager" class="side-nav-items active"> <a href="Login.php" class="nav-link active-link">Project Manager </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->	

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<h1> Project Manager Login </h1>
		<?php
			if(isset($_SESSION['user-name'])) {
				echo "Log out of all other sessions";
			}
		?>
		<form  method="post">
			<input type="text" pattern="^[0-9]{3}$" required='required' placeholder="Manager ID" name="pmanager"> <br/>
			<input type="password" required='required' placeholder="Password" name="pass"> <br/>
			<input type="text" pattern="^[a-zA-Z0-9]{6}$" required='required' placeholder="Captcha" name="captcha" id="real-person"> <br/>
			<input type="submit" value="Sign In" class="submit-delete-button">
		</form>
		<?php
			if(isset($_GET['logout'])){
				session_unset();
				session_destroy();
				header("Location: Login.php");
			}
		?>
	<?php
	    if($_POST) :
	    	function rpHash($value) { 
	    		$hash = 5381; 
	    		for($i = 0; $i < strlen($value); $i++) { 
	        	$hash = (($hash << 5) + $hash) + ord(substr($value, $i)); 
	    		} 
	    	return $hash; 
			} 
 			if (rpHash($_POST['captcha']) == $_POST['captchaHash']) {
			    $dbhost = 'localhost';
				$dbuser = 'root';
				$dbpass = '';
				$dbname = 'cmt';
				$flag=0;
			    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			    $pass=$_POST['pass'];
			    $id=$_POST['pmanager'];
			    $sqll = "select id from engineer";
			    $result_id = $conn->query($sqll);
			    while ($row_id = mysqli_fetch_array($result_id))
			    {
			    	if($row_id['id']==$id)
			    	{
			    		$flag = 1;
						$sql="select password from engineer where id='$id'";
						$passhash=crypt($pass,'$2a$'.$id);
			    		$result = $conn->query($sql);
			    		$row = mysqli_fetch_array($result);
			    			if ($passhash==$row['password']) {
			    				$_SESSION['user-name'] = $id;
			    				$_SESSION['user'] = "pmanager";
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
			    $conn->close();
			}
			else {
				echo "<p class='delete-message'>Invalid Captcha</p>";
			}
		endif;	
	?>
</div>
	<!-- The main content ends -->
</div>
</body>
</html>	