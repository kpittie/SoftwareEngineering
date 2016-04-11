<?php
     $host = 'localhost';
     $user = 'root';
     $pass = '';
           
     mysql_connect($host, $user, $pass);

     mysql_select_db('cmt');
      

     $pid = intval($_GET['q']);
     $find=mysql_query("select * from module where project_id=$pid");
     while($row=mysql_fetch_array($find))
     {
       echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
     }
     exit;
?>   