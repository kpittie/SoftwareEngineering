<?php
     $host = 'localhost';
     $user = 'root';
     $pass = '';
           
     $conn = mysqli_connect($host, $user, $pass, "cmt");
      
     $pid = intval($_GET['q']);
     
     $sql = "select project_id,module_id from engineer where id=$pid";
     $find = mysqli_query($conn,$sql);
     $row = mysqli_fetch_array($find);
     $project = $row['project_id'];

     $sql = "select * from project";
     $find=mysqli_query($conn,$sql);
     echo "<select name='project-id' onclick='trigfinal(this.value);check();' required>";
     while($row = mysqli_fetch_array($find))
     {
          if($row['id'] == $project)
               echo "<option value=$row[id] name='project-id' selected>$row[name]</option>";

          else
               echo "<option value=$row[id] name='project-id'>$row[name]</option>";
     }
     echo "</select>";
     exit;
?>   