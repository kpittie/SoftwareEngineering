<?php
	$user = 'Hello';
	$id = '12345678';
	$c = crypt($id, '$2a$'.$id);
	echo $c;
?>