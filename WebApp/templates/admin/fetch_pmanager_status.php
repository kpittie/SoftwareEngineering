<?php
     $host = 'localhost';
     $user = 'root';
     $pass = '';
           
     $conn = mysqli_connect($host, $user, $pass, "cmt");
      
     $mid = intval($_GET['q']);
     $sql = "select project_id from module where id=$mid";

     $result = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($result);
     $pid = $row['project_id'];

     $sql = "select * from project where id=$pid and manager_id is null";
     $result=mysqli_query($conn,$sql);
     $countpmanager = mysqli_num_rows($result);
     if($countpmanager == 0)
     {
          echo '<label id="radio-label"> Project Manager: <input type="radio" required="required" class="radio-input" name="pmanager" value="y" disabled>Yes <input type="radio" name="pmanager" class="radio-input" value="n">No </label>';
     }

     else
     {
          echo '<label id="radio-label"> Project Manager: <input type="radio" required="required" class="radio-input" name="pmanager" value="y">Yes <input type="radio" name="pmanager" class="radio-input" value="n">No </label>';          
     }
     exit;
?>   