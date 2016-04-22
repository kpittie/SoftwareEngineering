<?php
/**
 * Created by PhpStorm.
 * User: Harsh Saxena
 * Date: 14-04-2016
 * Time: 02:30 PM
 */
session_start();
include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Register Complaint</title>
    <!-- Importing the CSS and the font for the website donot alter the section below -->
    <link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
    <!-- Importing ends here -->

    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">

    <script>
        function trig(pid) {
            if (pid == "") {
                document.getElementById("module").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("module").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET","fetch_modules.php?q="+pid,true);
                xmlhttp.send();
            }
        }
    </script>

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
            <li id="register-problem" class="side-nav-items"> <a href="RegisterProblem.php" class="nav-link"> Register Complaint </a> </li>
            <li id="cancel-problem" class="side-nav-items"> <a href="CancelProblem.php" class="nav-link"> Cancel Complaint </a> </li>
            <li id="reopen-problem" class="side-nav-items"> <a href="ReopenProblem.php" class="nav-link"> Reopen Complaint </a> </li>
            <li id="problem-status" class="side-nav-items"> <a href="ProblemStatus.php" class="nav-link"> Complaint Status </a> </li>
        </ul>
    </aside>
    <!-- Side bar ends here -->

    <!-- This is the section where you'll add the main content of the page -->
    <div id="main">
        <?php
        if(isset($_SESSION['user-name']) && $_SESSION['user']=="client"){
            ?>
            <h1 class="main-heading"> Register Problem </h1>
            <p class="message"></p><br/>
            <form method="post">

            <select required="required" name="project" id="project" onchange="trig(this.value)">
                <option value="" selected="true" style="display:none;">Select project</option>
                <?php

                    $dbhost = 'localhost';
                    $dbuser = 'root';
                    $dbpass = '';
                    $dbname = 'cmt';  
                    $username = $_SESSION['user-name'];                         
                      $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
                      $sql = "select * from project WHERE client_id=$username";         
                      $result = $conn->query($sql);
                    while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }      
                    
                ?>
                </select>
                </br>
            <select id="module" name="module" required>
            </select>
                <br/>
                <textarea name="description" id="description" rows="10" cols="50" class="form-center">
                    Problem Description
                </textarea>
                <select id="priority" name="priority" class="form-center" required>
                    <option selected="selected" disabled="disabled">Select Priority</option>
                    <option value="H">High</option>
                    <option value="M">Medium</option>
                    <option value="L">Low</option>
                </select>
                <input type="submit" value="Register" class="submit-delete-button">
            </form>

            <?php

            if($_POST) :
                $projectId = $_POST["project"];
                $moduleId = $_POST["module"];
                $description = $_POST['description'];
                $priority = $_POST['priority'];
                $timestamp=date("Y/m/d");
                $status_complaint="U";

                $engineerId=0;

                $number_of_complaints=0;
                $status_engineer="Assigned";
                $total_complaints=0;

                $projectProblem=0;
                $query="SELECT id,status,number_of_complaints,total_complaints FROM engineer where project_id=$projectId AND module_id=$moduleId";
                $result = mysqli_query($conn,$query);
                $flag=0;
                if (mysqli_num_rows($result) > 0) {
                    //all possible engineers for the particular project and module
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["status"]=="unassigned") {
                            $engineerId = $row["id"];
                            $number_of_complaints = 1;
                            $status_engineer="Assigned";
                            $total_complaints=$row["total_complaints"]+1;
                            $status_complaint="A";
                            $flag=1;
                            break;
                        }
                    }
                    if($flag==0){
                        //no free engineer, therefore assign to first engineer in the given project and module
                        $query="SELECT id,number_of_complaints,total_complaints FROM engineer where project_id=$projectId AND module_id=$moduleId ORDER BY number_of_complaints";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                            $engineerId = $row["id"];
                            $number_of_complaints=$row["number_of_complaints"]+1;
                            $total_complaints=$row["total_complaints"]+1;
                            $status_complaint="A";
                            break;
                        }
                    }
                }
                else{
                    echo "<p class='error-message'> No Engineer in the project!!! </p>";
                }


                $sql = "UPDATE engineer SET number_of_complaints=$number_of_complaints,status='$status_engineer',total_complaints=$total_complaints WHERE id=$engineerId";

                if (mysqli_query($conn, $sql)) {
                    echo "<p class='create-message'> Engineer Assigned </p>";

                    $sql = "INSERT into problem(description,project_id,module_id,engineer_id,timestamp,status,priority) VALUES  ('$description',$projectId,$moduleId,$engineerId,'$timestamp','$status_complaint','$priority')";
                    if (mysqli_query($conn, $sql)) {
                        $problem_id=mysqli_insert_id($conn);
                        echo "<p class='create-message' >Problem Id:</p>";
                        echo "<p class='create-message' id='prob_id'>$problem_id </p>";
                    }

                    $sql = "UPDATE project SET problems=problems+1 WHERE id=$projectId";
                    mysqli_query($conn,$sql);

                }
                else {
                    echo "Error in Submission: ";
                }
               endif;
            ?>
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
<script src="../../scripts/timer.js"></script>
</body>
</html>
