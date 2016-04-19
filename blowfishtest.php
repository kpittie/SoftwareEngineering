<?php
	$user = 'Hello';
	$id = '123';
	$c = crypt($user, '$2a$'.$id);
	echo $c;


	if( password_verify($user, $c) )
	{
		echo "WORKS";
	}
	else{
		echo "FAIL";
	}
?>