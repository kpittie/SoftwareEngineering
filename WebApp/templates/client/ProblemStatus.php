
<!DOCTYPE HTML>
<html>
<head>
    <title>Project Status </title>
    <!-- Importing the CSS and the font for the website donot alter the section below -->
    <link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
    <!-- Importing ends here -->

    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <script src="../../scripts/js-admin-add-project.js"> </script>
    <style>
        div1 {
            margin: auto;
        }</style>
</head>

<body>


<div id="container">
    <!-- This is the top nav bar donot make changes here -->
    <nav id="top-nav">
        <ul id="top-nav-list">
            <li class="top-nav-item" id="logo"> <img src="../../images/logo.png" alt="logo" id="logo-image"> </li>

            <li class="top-nav-item" id="logout-button"> <a id="logout-link" href="login.php?logout=1"> Logout </a> </li>
        </ul>
    </nav>
    <!-- Top Nav Bar ends here -->

    <!-- Side bar is below make changes to li(id), li(content) rest should not be changed and donot remove any classes or ids except for the ones that contain the names of the list items -->
    <aside id="side-nav">
        <ul id="side-nav-list">
            <li id="add-project" class="side-nav-items"> <a href="http://localhost:80/SoftwareEngineering/WebApp/templates/admin/AddProject.php" class="nav-link"> Add Project </a> </li>
            <li id="delete-project" class="side-nav-items"> <a href="http://localhost/SoftwareEngineering/WebApp/templates/client/delete_problem.php" class="nav-link"> Delete Project </a> </li>
            <li id="add-client" class="side-nav-items"> <a href="http://localhost/SoftwareEngineering/WebApp/templates/client/reopen_project.php"> Re-open Project </a> </li>
            <li id="add-engineer" class="side-nav-items"> <a href="http://localhost/SoftwareEngineering/WebApp/templates/client/problem_status.php" class="nav-link"> Project status </a> </li>

        </ul>
    </aside>
    <!-- Side bar ends here --><br><br><br><br><br><br><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Enter the problem id:
        <input type="text" name="pid"/>
        <input type="submit" value="Search">
    </form>

    <!-- This is the section where you'll add the main content of the page -->
    <div id="main">

        <!-- The main content ends -->

        <div1>
            <?php
            if($_POST) :
            $con = mysqli_connect("localhost","root","","test");
            $id=$_POST['pid'];
            $query = "select * from problem where id = $id";
            if($result = mysqli_query($con,$query)) {
                $rowcount = mysqli_num_rows($result);
                if ($rowcount == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<table>";
                        echo "<tr>";
                        echo "<td> Project Id: </td>";
                        echo "<td> Engineer Id: </td>";
                        echo "<td> Time-stamp Id: </td>";
                        echo "<td> Status: </td>";
                        echo "<td> Priority: </td>";
                        echo "<td> Reopening: </td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> $row[project_id]</td>";
                        echo "<td> $row[engineer_id]</td>";
                        echo "<td> $row[timestamp]</td>";
                        echo "<td> $row[status]</td>";
                        echo "<td> $row[priority]</td>";
                        echo "<td> $row[reopening]</td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                }
            }
            else
            {
                echo "<b>Sorry no such record found!!</b>";
            }
            endif;
            ?>

        </div1>

    </div>
</body>
</html>