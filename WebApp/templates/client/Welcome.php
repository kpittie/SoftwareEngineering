<?php
/**
 * Created by PhpStorm.
 * User: Harsh Saxena
 * Date: 14-04-2016
 * Time: 1:10 PM
 */
session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Welcome </title>
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

    <!-- Side nav bar is below make changes  -->
    <aside id="side-nav">
        <ul id="side-nav-list">
            <li id="home" class="side-nav-items active"> <a href="Welcome.php" class="nav-link"> Home </a> </li>
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
            <h1 class="main-heading"> Welcome Client ID: <?php echo $_SESSION['user-name']; ?> </h1>
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
