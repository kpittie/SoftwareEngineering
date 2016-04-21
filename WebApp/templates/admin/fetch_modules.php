<?php
     $host = 'localhost';
     $user = 'root';
     $pass = '';
           
     $conn = mysqli_connect($host, $user, $pass, "cmt");
      
     $pid = intval($_GET['q']);
     
     $sql = "select * from module where project_id=$pid";
     $find=mysqli_query($conn,$sql);
     echo '<select id="module-name" name="module-name" required="required">';  
     while($row=mysqli_fetch_array($find))
     { 
       echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
     }
     echo '</select> <br/>';

     $pman = "select * from project where manager_id is null and id=$pid";
     $result=mysqli_query($conn,$pman);
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