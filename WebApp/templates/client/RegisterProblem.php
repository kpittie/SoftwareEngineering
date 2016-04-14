<?php
/**
 * Created by PhpStorm.
 * User: Harsh Saxena
 * Date: 14-04-2016
 * Time: 02:30 PM
 */
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Register Problem</title>
    <!-- Importing the CSS and the font for the website donot alter the section below -->
    <link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
    <!-- Importing ends here -->

    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">

    <script src="../../scripts/js-admin-add-project.js"> </script>
</head>

<body>
<div id="container">
    <!-- This is the top nav bar donot make changes here -->
    <nav id="top-nav">
        <ul id="top-nav-list">
            <li class="top-nav-item" id="logo"> <img src="../../images/logo.png" alt="logo" id="logo-image"> </li>

            <li class="top-nav-item" id="logout-button"> <a id="logout-link" href="Login.php?logout=1"> Logout </a> </li>
        </ul>
    </nav>
    <!-- Top Nav Bar ends here -->

    <!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
    <aside id="side-nav">
        <ul id="side-nav-list">
            <li id="register-problem" class="side-nav-items"> <a href="RegisterProblem.php" class="nav-link"> Register Problem </a> </li>
            <li id="cancel-problem" class="side-nav-items"> <a href="CancelProblem.php" class="nav-link"> Cancel Problem </a> </li>
            <li id="reopen-problem" class="side-nav-items"> <a href="ReopenProblem.php" class="nav-link"> Reopen Problem </a> </li>
            <li id="problem-status" class="side-nav-items"> <a href="ProblemStatus.php" class="nav-link"> Problem Status </a> </li>
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

                <select id="project" name="project" class="form-center" required>
                    <?php
                    $dbhost = 'localhost';
                    $dbuser = 'root';
                    $dbpass = '';
                    $dbname = 'cmt';

                    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

                    if($conn->connect_error)
                    {
                        die("connection failed: ". $conn->connect_error);
                    }

                    $query= "SELECT id,name FROM project where client_id= " .$_SESSION['user-name']. " ";
                    $result=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $name = $row['name'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    }
                    ?>
                    <option selected="selected" disabled="disabled">Select a Project</option>
                </select>

                <select id="module" name="module" class="form-center" required>
                    <?php
                    $query= "SELECT module.id,module.name FROM module INNER JOIN project on module.project_id=project.id where project.client_id= " .$_SESSION['user-name']. " ";
                    $result=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $name = $row['name'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    }
                    ?>
                    <option selected="selected" disabled="disabled">Select a Module</option>
                </select>
                <br/>
                <textarea name="description" id="description" rows="10" cols="50" class="form-center">
                    Problem Description
                </textarea>
                <select id="priority" name="priority" class="form-center"required>
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
                $date=date("Y/m/d");
                $status_complaint="U";

                $engineerId=0;

                $number_of_complaints=0;
                $status_engineer="";
                $total_complaints=0;
                $query="SELECT id,status,number_of_complaints,total_complaints FROM engineer where project_id=$projectId AND module_id=$moduleId";
                $result = mysqli_query($conn, $query);
                $flag=0;
                if (mysqli_num_rows($result) > 0) {
                    //all possible engineers for the particular project and module
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["status"]=="unassigned") {
                            $engineerId = $row["id"];
                            $number_of_complaints = 1;
                            $status_engineer="Assigned";
                            $total_complaints=$row["total_complaints"]+1;
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
                            break;
                        }
                    }
                }
                else{
                    echo "<p class='error-message'> No Engineer in the project!!! </p>";
                }

                
                $sql = "INSERT INTO project (name) VALUES ('$name')";

                if (mysqli_query($conn, $sql)) {
                    echo "<p class='create-message'> New project created successfully </p>";
                }

                $sql = "SELECT id FROM project WHERE name='$name'";
                $result = $conn->query($sql);
                $ide = $result->fetch_assoc();
                $id = $ide["id"];


                $modules = $_POST["Modules"];

                foreach ($modules as $module)
                {
                    $sql = "INSERT INTO module (name,project_id) VALUES ('$module',$id)";
                    if (mysqli_query($conn, $sql)) {
                        echo "<p class='create-message'> New modules created successfully </p>";
                    }
                }
            endif;
            mysqli_close($conn);
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
</body>
</html>
