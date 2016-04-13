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

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<h1> Administrator Login </h1>
		<form  method="post">
			<input type="text" placeholder="Admin ID" name="admin"> <br/>
			<input type="password" placeholder="Password" name="pass"> <br/>
			<input type="text" placeholder="Captcha" name="captcha" id="real-person"> <br/>
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
			    $id=$_POST['admin'];
			    $sqll = "select id from admin";
			    $result_id = $conn->query($sqll);
			    while ($row_id = mysqli_fetch_array($result_id))
			    {
			    	if($row_id['id']==$id)
			    	{
			    		$flag = 1;
						$sql="select password from admin where id='$id'";
			    		$result = $conn->query($sql);
			    		$row = mysqli_fetch_array($result);
			    			if ($pass==$row['password']) {
			    				$_SESSION['user-name'] = $id;
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