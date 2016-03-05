<?php

$connect=mysql_connect("localhost","root","") or die("Couldn't not connect to SQL!!!");
mysql_select_db("cmt",$connect)or die("Couldn't to connect to Database");

/*if(mysql_select_db("cmt",$connect))
{
echo "success";
}*/

?>