<?php
     $host = 'localhost';
     $user = 'root';
     $pass = '';

     mysqli_connect($host, $user, $pass);

     mysqli_select_db('cmt');


     $pid = intval($_GET['q']);
     $find=mysqli_query("select * from module where project_id=$pid");
     while($row=mysqli_fetch_array($find))
     {
         echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
     }
     exit;
?>   