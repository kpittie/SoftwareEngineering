
<?php
/**
 * Created by NOTEPAD++
 * User: INDRANIL OJHA
 * Date: 14-04-2016
 * Time: 1:10 PM
 */
$connect=mysqli_connect("localhost","root","") or die("Couldn't not connect to SQL!!!");
mysqli_select_db($connect,"cmt")or die("Couldn't to connect to Database");
?>