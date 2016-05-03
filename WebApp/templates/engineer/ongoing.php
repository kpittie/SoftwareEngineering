<?php
/**
 * Created by NOTEPAD++
 * User: THIRUMURGAN S.S.
 * Date: 14-04-2016
 * Time: 1:10 PM
 */
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	  <title> ONGOING PROBLEMS </title>
	  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="../../styles/prettify1.css">
	  <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	  <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <style>
	  .jumbotron {
      background-color:  #ccffe6;
      color: #fff;
      padding: 50px 30px;
      font-family: Montserrat, sans-serif;
        }
      #clock{
	position:absolute;
	left:500px;
	top:0px;
	width:190px;
	height:43px;
       }
	  </style>
<script>
	function func(pid) {
		document.getElementById('pid').value = pid;
	}
</script>
</head>

<body>
<aside id="side-nav">
		<ul id="side-nav-list">
			<br><br>
			
			<li id="add-engineer" class="side-nav-items"> <a href="ongoing.php" class="nav-link"> Ongoing Problems </a> </li>
			<br>
			<li id="session-tracking" class="side-nav-items"> <a href="complete.php" class="nav-link"> Completed Problems </a> </li>
			
		</ul>
</aside>
<div class="container-fluid">
<nav class="navbar navbar-inverse navbar-fixed-top">
  
    <div class="navbar-header">
	<a class="navbar-brand" href="#myPage"><img class="img-circle" src="../../images/logo.png" width="50px" height="38px"></a>
      <a class="navbar-brand" href="#">ONGOING PROBLEMS</a>
	 <a class="navbar-brand" href="#myPage"> <div id="clock">
	<object width="200" height="50" data="../../images/clock.swf"></object>
	</div></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="signout1.php"><span class="glyphicon glyphicon-home">Home</span></a></li>
     
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  
</nav>



<?php

include ("db_connect.php");
if(isset($_SESSION['id']))
{
echo "<br><br><br><br>";

$pid=$_SESSION['id'];
//echo $pid;
$query= "select id,description,timestamp,status,priority from problem where status='A' and engineer_id=$pid";

$result=mysqli_query($connect,$query);
//var_dump($result);
echo "<table>";
echo "<th>Problem ID</th><th>Description</th><th>Timestamp</th><th>Status</th><th>Priority</th><th>Submit Solution</th>";

while($row=mysqli_fetch_array($result))
	{ 
	
    echo "<tr>";
    $pid = $row['id'];
    echo "<td>".$row['id']."</td>"."<td>".$row['description']."</td>"."<td>".$row['timestamp']."</td>"."<td>".$row['status']."</td>"."<td>".$row['priority']."</td><td><button class='' name='first-click' data-toggle='modal' data-target='#myModal' onclick='func($row[id])'>Submit Solution</button></td></tr>";
    }
echo "</table>";
}
else
{
echo "<br>";
echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<h3>You need to <a href='Login.php'>LOGIN</a> first</h3>";
}

?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Solution</h4>
      </div>
      <div class="modal-body">
	    <form method="post">
	    	<input type="hidden" id="pid" name="pid">
	    	<textarea id="solution" name="solution" rows="10" cols="50" placeholder="Enter the solution comments"></textarea> <br>
	    	<input type="text" name="hours" placeholder="Number of Hours"> <br>
	    	<hr>
	    	<input type="submit" name="submit-solution" value="Submit Solution">
	    </form>
	   </div>
	 </div>
  </div>
</div>

<?php
	if(isset($_POST['submit-solution']))
	{
		$solution = $_POST['solution'];
		$hours = $_POST['hours'];
		$pid = $_POST['pid'];
		$id = $_SESSION['id'];
		$sql = "UPDATE problem SET solution_comment='$solution', number_of_hours=$hours, status='C' WHERE id=$pid";
		mysqli_query($connect, $sql);
		$sql = "UPDATE engineer SET number_of_complaints=number_of_complaints-1 WHERE id=";
		mysqli_query($connect,$sql);
		$sql = "SELECT number_of_complaints from engineer WHERE id=$id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
			if($row['number_of_complaints'] == 0)
			{
				$sql = "UPDATE engineer SET status='unassigned' WHERE id=$id";
				mysqli_query($connect,$sql);
			}
		header("location: ongoing.php");
	}
?>


</div>
</body>
</html>	
