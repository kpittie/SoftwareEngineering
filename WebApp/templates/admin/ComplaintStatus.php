<?php
	session_start();
	include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title> Complaint Status</title>
	<!-- Importing the CSS and the font for the website donot alter the section below -->
	<link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../../images/logo.png">
	<!-- Importing ends here -->
	<link rel="stylesheet" type="text/css" href="../../styles/admin.css">
	<link rel="stylesheet" href="../../Plugins/modal/reveal.css">
	<script src="../../Plugins/modal/jquery-1.4.4.min.js" type="text/javascript"></script>
	<script src="../../Plugins/modal/jquery.reveal.js" type="text/javascript"></script>
	<script type="text/javascript" src="../../Plugins/graphs/jquery.canvasjs.min.js"></script>
</head>

<body>
<div id="container">	
	<!-- This is the top nav bar donot make changes here -->
	<nav id="top-nav">
		<ul id="top-nav-list">
			<li class="top-nav-item" id="logo"> <img src="../../images/logo.png" alt="logo" id="logo-image"> </li> 
			<li class="top-nav-item" id="digital-clock"> <div id="clockDisplay" class="clockStyle"> </div> </li>
			<li class="top-nav-item" id="logout-button"> <a id="logout-link" href="Login.php?logout=1"> Logout </a> </li>
		</ul>
	</nav>
	<!-- Top Nav Bar ends here -->

	<!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
	<aside id="side-nav">
		<ul id="side-nav-list">
			<li id="home" class="side-nav-items"> <a href="Welcome.php" class="nav-link"> Home </a> </li>
			<li id="add-project" class="side-nav-items"> <a href="AddProject.php" class="nav-link"> Add Project </a> </li>
			<li id="delete-project" class="side-nav-items"> <a href="DeleteProject.php" class="nav-link"> Delete Project </a> </li>
			<li id="add-client" class="side-nav-items"> <a href="AddClient.php" class="nav-link"> Add Client </a> </li>
			<li id="add-engineer" class="side-nav-items"> <a href="AddEngineer.php" class="nav-link"> Add Engineer / Project Manager </a> </li>
			<li id="session-tracking" class="side-nav-items"> <a href="SessionTracking.php" class="nav-link"> Session Tracking </a> </li>
			<li id="complaint-status" class="side-nav-items active"> <a href="ComplaintStatus.php" class="nav-link active-link"> Complaint Status </a> </li>
		</ul>
	</aside>
	<!-- Side bar ends here -->

	<!-- This is the section where you'll add the main content of the page -->
	<div id="main">
		<?php
			if(isset($_SESSION['user-name']) && $_SESSION['user']=="admin"){
		?>
		<h1 class="main-heading"> Complaint Status </h1>
		<form method="post">		
			<input type="submit" value="Unassigned Complaints" class="unassigned-complaints-button" name="unassigned-button">
			<input type="submit" value="All Complaints" class="all-complaints-button" name="all-complaints-button">
		</form>

		<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cmt';

		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		if(isset($_POST['unassigned-button'])) {
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM problem WHERE engineer_id IS NULL OR status='U' ORDER BY priority='H' DESC, priority='M' DESC, priority='L' DESC";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table border='1'>";
			echo "	<tr>";
			echo "		<th> ID </th>";
			echo "		<th> Description </th>";
			echo "		<th> Project ID </th>";
			echo "		<th> Module ID </th>";
			echo "		<th> Engineer ID </th>";
			echo "		<th> Status </th>";
			echo "		<th> Priority </th>";
			echo "		<th> Reopenings </th>";
			echo "		<th> Timestamp </th>";
			echo "	</tr>"; 
		    while($row = $result->fetch_assoc()) {
		    	if($row["status"] == 'U')
		    		$status = "Unassigned";
		    	else if($row["status"] == 'A')
		    		$status = "Assigned";
		    	else if($row["status"] == 'C')
		    		$status = "Completed";
		    	else
		    		$status = "Ongoing";

		    	if($row["priority"] == 'H')
		    		$priority = "High";
		    	else if($row["priority"] == 'L')
		    		$priority = "Low";
		    	else
		    		$priority = "Medium";

		    	echo "<tr class='invalid-row'>";
		        echo "<td>" . $row["id"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td><strong>" . $status. "</strong></td> <td>" . $priority. "</td> <td>" . $row["reopenings"]. "</td> <td>" . $row["timestamp"]. "</td>";
		        echo "</tr>";
		    }
		echo "<button class='show-button' onclick='show()'><a href='#' class='link-show' data-reveal-id='myModal2'>Visualize</a></button>";    
				
		$sql = "SELECT count(*) FROM problem WHERE priority='H' AND status='U'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$high_count = $row["count(*)"];
		echo "<input type='hidden' value=$high_count id='high-count'>";

		$sql = "SELECT count(*) FROM problem WHERE priority='M' AND status='U'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$medium_count = $row["count(*)"];
		echo "<input type='hidden' value=$medium_count id='medium-count'>";

		$sql = "SELECT count(*) FROM problem WHERE priority='L' AND status='U'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$low_count = $row["count(*)"];
		echo "<input type='hidden' value=$low_count id='low-count'>";
		} else {
		    echo "<br/><br/><hr><br/><strong>0 results</strong>";
		}
		}

		else if(isset($_POST['all-complaints-button']) || (!isset($_POST['unassigned-button']))) {
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		echo "<table border='1'>";
		echo "	<tr>";
		echo "		<th> ID </th>";
		echo "		<th> Description </th>";
		echo "		<th> Project ID </th>";
		echo "		<th> Module ID </th>";
		echo "		<th> Engineer ID </th>";
		echo "		<th> Status </th>";
		echo "		<th> Priority </th>";
		echo "		<th> Reopenings </th>";
		echo "		<th> Timestamp </th>";
		echo "	</tr>"; 

		$sql = "SELECT * FROM problem ORDER BY status='U' DESC, status='A' DESC, status='C' DESC, priority='H' DESC, priority='M' DESC, priority='L' DESC";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	if($row["status"] == 'U')
		    		$status = "Unassigned";
		    	else if($row["status"] == 'A')
		    		$status = "Assigned/Ongoing";
		    	else if($row["status"] == 'C')
		    		$status = "Completed";
		    	else
		    		$status = "Ongoing";

		    	if($row["priority"] == 'H')
		    		$priority = "High";
		    	else if($row["priority"] == 'L')
		    		$priority = "Low";
		    	else
		    		$priority = "Medium";
		    	
		    	if($row["engineer_id"] == NULL || $row["status"] == 'U' || $row["status"] == 'u')
		    	{
			    	echo "<tr class='invalid-row'>";
			        echo "<td>" . $row["id"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td><strong>" . $status. "</strong></td> <td>" . $priority. "</td> <td>" . $row["reopenings"]. "</td> <td>" . $row["timestamp"]. "</td>";
			        echo "</tr>";
			    }
			    else if($row["status"] == 'C' || $row["status"] == 'c')
			    {
			    	echo "<tr class='completed-row'>";
			        echo "<td>" . $row["id"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td><strong>" . $status. "</strong></td> <td>" . $priority. "</td> <td>" . $row["reopenings"]. "</td> <td>" . $row["timestamp"]. "</td>";
			        echo "</tr>";
			    }
			    else
			    {
			    	echo "<tr class='valid-row'>";
			        echo "<td>" . $row["id"]. "</td> <td>" . $row["description"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["engineer_id"]. "</td> <td><strong>" . $status. "</strong></td> <td>" . $priority. "</td> <td>" . $row["reopenings"]. "</td> <td>" . $row["timestamp"]. "</td>";
			        echo "</tr>";
			    }
		    }
		echo "<button class='show-button' onclick='showall()'><a class='link-show' href='#' data-reveal-id='myModal'>Visualize</a></button>";    
		} else {
		    echo "<br><br><hr><br><strong>0 results</strong>";
		}
		$sql = "SELECT count(*) FROM problem WHERE status='U'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$unassigned_count = $row["count(*)"];
		echo "<input type='hidden' value=$unassigned_count id='unassigned-count'>";

		$sql = "SELECT count(*) FROM problem WHERE status='A'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$assigned_count = $row["count(*)"];
		echo "<input type='hidden' value=$assigned_count id='assigned-count'>";

		$sql = "SELECT count(*) FROM problem WHERE status='C'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$completed_count = $row["count(*)"];
		echo "<input type='hidden' value=$completed_count id='completed-count'>";
		}
		$conn->close();
	?>
	</table>
	<?php
		}
		else
		{
			echo "<p class='delete-message'> You must be logged in to see this page </p>";
		}
	?>						
	</div>
	<!-- The main content ends -->
</div>
<div id="myModal" class="reveal-modal">
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    <a class="close-reveal-modal">&#215;</a>
</div>

<div id="myModal2" class="reveal-modal">
	<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
	<a class="close-reveal-modal">&#215;</a>
</div>
<script src="../../scripts/timer.js"></script>
</body>

<script type="text/javascript">
	function showall() {
	var unassigned_count = +document.getElementById("unassigned-count").value;
	var assigned_count = +document.getElementById("assigned-count").value;
	var completed_count = +document.getElementById("completed-count").value;
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "Complaints Stats"
		},
                animationEnabled: true,
		legend:{
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 10,
			fontFamily: "Helvetica"        
		},
		theme: "theme1",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 11,
			indexLabel: "{label} {y}",
			startAngle:-20,      
			showInLegend: true,
			toolTipContent:"{legendText} {y}",
			dataPoints: [
				{  y: unassigned_count, legendText:"Unassigned Complaints", label: "Unassigned Complaints: " },
				{  y: assigned_count, legendText:"Assigned Complaints", label: "Assigned Complaints: " },
				{  y: completed_count, legendText:"Completed Complaints", label: "Completed Complaints: " }
			]
		}
		]
	});
	chart.render();
}
</script>

<script type="text/javascript">
  function show() {
  	var c = +document.getElementById("high-count").value;
  	var b = +document.getElementById("medium-count").value;
  	var a = +document.getElementById("low-count").value;
    var chart = new CanvasJS.Chart("chartContainer2",
    {
      title:{
        text: "Unassigned Complaints Stats"    
      },
      animationEnabled: true,
      axisY: {
        title: "Unassigned Complaints"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Complaints",
        dataPoints: [      
        {y: a, label: "Low"},
        {y: b,  label: "Medium" },
        {y: c,  label: "High"}       
        ]
      }   
      ]
    });
    chart.render();
  }
  </script>

  </html>	
