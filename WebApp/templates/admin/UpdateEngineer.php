<?php
     session_start();
     include '../../scripts/timeout.php';
?>
<!DOCTYPE HTML>
<html>
<head>
     <title> Update Engineer </title>
     <!-- Importing the CSS and the font for the website donot alter the section below -->
     <link rel="stylesheet" type="text/css" href="../../styles/prettify.css">
     <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
     <link rel="icon" type="image/png" href="../../images/logo.png">
     <!-- Importing ends here -->

     <script>
          function trig(pid) {
              if (pid == "") {
                  document.getElementById("engineer-details").innerHTML = "";
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
                          document.getElementById("engineer-details").innerHTML = xmlhttp.responseText;
                      }
                  };
                  xmlhttp.open("GET","fetch_engineer_details.php?q="+pid,true);
                  xmlhttp.send();
              }
          }
     </script>
          <script>
          function trigfinal(pid) {
              if (pid == "") {
                  document.getElementById("final-details").innerHTML = "";
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
                          document.getElementById("final-details").innerHTML = xmlhttp.responseText;
                      }
                  };
                  xmlhttp.open("GET","fetch_final_details.php?q="+pid,true);
                  xmlhttp.send();
              }
          }
     </script>
     <script>
         function redirect() {
               window.location="AddEngineer.php";
        }
     </script>
     <script>
          function check() {
               document.getElementById('check-field').value = "true";
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
               <li id="add-project" class="side-nav-items"> <a href="AddProject.php" class="nav-link"> Add Project </a> </li>
               <li id="delete-project" class="side-nav-items"> <a href="DeleteProject.php" class="nav-link"> Delete Project </a> </li>
               <li id="add-client" class="side-nav-items"> <a href="AddClient.php" class="nav-link"> Add Client </a> </li>
               <li id="add-engineer" class="side-nav-items active"> <a href="AddEngineer.php" class="nav-link active-link"> Add Engineer / Project Manager </a> </li>
               <li id="session-tracking" class="side-nav-items"> <a href="SessionTracking.php" class="nav-link"> Session Tracking </a> </li>
               <li id="complaint-status" class="side-nav-items"> <a href="ComplaintStatus.php" class="nav-link"> Complaint Status </a> </li>
          </ul>
     </aside>
     <!-- Side bar ends here -->

     <!-- This is the section where you'll add the main content of the page -->
     <div id="main">
          <?php
               if(isset($_SESSION['user-name']) && $_SESSION['user']=="admin") {
          ?>
          <h1 class="main-heading"> Update Engineer / Project Manager </h1>
          <div id='engineer'>
          <form method="post" action="">
               <input type='submit' value='Back' name='update-button' class='submit-delete-button' onclick='redirect()'> <br/>
               <select name='engineer-id' onchange="trig(this.value);" required>
                    <?php
                         $host = 'localhost';
                         $user = 'root';
                         $pass = '';
           
                         $conn = mysqli_connect($host, $user, $pass, "cmt");

                         $sql = "select * from engineer where status='unassigned'";
                         $find = mysqli_query($conn,$sql);
                         echo '<option value="" selected="true" style="display:none;">Select Engineer</option>';
                         while($row=mysqli_fetch_array($find))
                         { 
                           echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
                         }
                        echo "</select>";
                        $sql = "select * from engineer";
                         $find = mysqli_query($conn,$sql);
                         while($row=mysqli_fetch_array($find))
                         {
                           $sqll = "select project_id,module_id from engineer where id=$row[id]";
                                $finds = mysqli_query($conn,$sqll);
                                $rows = mysqli_fetch_array($finds);
                                $module = $rows['module_id']; 
                            echo '<input type="hidden" value="'.$module.'" name="test" id="'.$row['id'].'">';
                         }
                    ?>
               <div id='engineer-details' name='engineer-details'>
               </div>
               <div id='final-details' name='final-details'>
               </div>
               <input type="hidden" value="not" name="check-field" id="check-field">
               <br>
     <?php
     $host = 'localhost';
     $user = 'root';
     $pass = '';
           
     $conn = mysqli_connect($host, $user, $pass, "cmt");

     if(isset($_POST['update-set-button'])):
               $test = $_POST["check-field"];
               if($test == "not")
               {
                    echo "<p class='delete-message'> Please select a project / Click on a project and select a module as well </p>";
               }
               else{
               $pid = $_POST["project-id"];
               $mid = $_POST["module-id"];
               $id = $_POST["engineer-id"];
               $pmanager = $_POST["pmanager"];
               $flag = 0;
               $flage = 0;

               $sql = "UPDATE engineer SET project_id='$pid', module_id='$mid', project_manager='$pmanager', number_of_complaints=0, total_complaints=0, status='unassigned' WHERE id='$id'";
               
               if (mysqli_query($conn, $sql)) {
               $flag = 1;
               }

               $sql = "UPDATE project SET manager_id = NULL WHERE manager_id='$id'";
               mysqli_query($conn, $sql);

               if($pmanager == 'y' && $flag==1)
               {
               $sql = "UPDATE project SET manager_id = '$id' WHERE id = '$pid'";
                    if (mysqli_query($conn, $sql)) 
                    {
                    $flage = 1;
                    }
               }

               if($flag==1 && $flage==1)
               {
                    echo "<p class='create-message'> New Project Manager updated successfully </p>";
               }
               else if($flag==1)
               {
                    echo "<p class='create-message'> Engineer updated successfully </p>";
               }
               else
               {
                    echo "<p class='delete-message'> Oops something went wrong </p>";
               }}
          endif;
          mysqli_close($conn);
     ?>
     <?php
      }
      else {
          echo "<p class='delete-message'> You must be logged in to see this page </p>";
      }
     ?>
     </div>
     <!-- The main content ends -->
</div>
<script src="../../scripts/timer.js"></script>
</body>
</html>   
