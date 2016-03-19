<?php
session_start();
include("home1.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome Engineer</title>
<style>
#a4{
float:right;
}
#k1{
float:right;
font-family:copper black;
font-size:20px;
font-weight:20px;
font-style:inherit;
border-spacing:20px 20px;
text-align:left;
}
.log{
display: block;
width: 40%;
height: 25px;
margin-left: auto;
margin-right: auto;
background-color: white;
font-family: copper black;
font-size: 20px;}

.cap{
top:200px;
text-align:center;
border:2px solid red;
}
input:select{
border:5px solid blue;
}
input:hover{
background-color:cyan;
}
.style2{
color:red;
}

</style>
</head>

<body>
<?php

include("db_connect.php");
extract($_POST);
session_start();
if(!isset($_SESSION['secure']))
{
$_SESSION['secure']=rand(1000,9999);

}
if(isset($submit))
{
	//$pass=$_POST['loginid'];
	//$loginid=$_POST['pass'];
	$rs=mysql_query("select * from admin where username='$loginid' and password='$pass'");
	 
	if(mysql_num_rows($rs)<1)
	{
		$found="N";
		 
	}
	else
    {
    if($_SESSION['secure']==$_POST['secure'])
    {
    
    $_SESSION[login]=$loginid;

}
else{
$abc="N";
$_SESSION['secure']=rand(1000,9999);
}
}
}
?>
<?php
if(isset($_SESSION['login']))
{
@header('Location:engineer_page.php');
}
?>
<img src="eng.png" title="ENGINEER LOGIN" id="a4" width="250" height="250">
<form name="form1" method="post" action="">
      <table width="200" border="0" id="k1">
        <tr>
          <td><span class="style2">Username</span></td>
          <td><input name="loginid" type="text" id="loginid2"></td>
        </tr>
        <tr>
          <td><span class="style2">Password</span></td>
          <td><input name="pass" type="password" id="pass2"></td>
        </tr>
		<tr>
          <td><span class="style2">Captcha</span></td>
          <td><input name="secure" type="text" id="captcha1"></td>
        </tr>
        <tr>
          <td colspan="2"><span class="errors">
            <?php
		  if(isset($found))
		  {
		  	echo "Invalid Username or Password";
		  }
		  ?>
          </span></td>
          </tr>
        <tr>
		<td id="a3"></td>
          <td  align=center class="cap">
		  <img src="generate.php" alt="captcha" id="a2" title="Enter CAPTCHA!!"><br></td></tr>
		   <tr>
          <td colspan="2"><span class="errors">
            <?php
			if(isset($abc))
			{
			echo 'Incorrect Captcha';
			}
			?>
		 </span></td>
          </tr>
        <tr><td colspan=2 align=center class="log">
		  <input name="submit" type="submit" id="submit" value="Login"></td>
        </tr>
        </table>
      </form>
</body>
</html>


