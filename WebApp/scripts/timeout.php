<?php
	if(time() - $_SESSION['timestamp'] > 1800) 
	{
    	unset($_SESSION['username'], $_SESSION['password'], $_SESSION['timestamp']);
    	session_destroy();
		header("Location: Login.php");
		exit;
	} 
	else 
	{
    	$_SESSION['timestamp'] = time(); //set new timestamp
	}
?>