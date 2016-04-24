<?php          
     $dbhost = 'localhost';
     $dbuser = 'root';
     $dbpass = '';
     $dbname = 'cmt';

     $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

     $engineer_id = intval($_GET['q']);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }


     $sql = "SELECT * FROM engineer WHERE id=$engineer_id";
     $result = $conn->query($sql);

     if($result->num_rows > 0) {
      $row = $result->fetch_assoc();
          if($row['project_manager']=='y')
          {
               $pmanstatus = 'Yes';
          }
          else
          {
               $pmanstatus = 'No';
          }
      echo "<dl>";
      echo "<dt>Engineer ID</dt><dd>".$row['id']."</dd><hr>";
      echo "<dt>Project ID</dt><dd>".$row['project_id']."</dd><hr>";
      echo "<dt>Module ID</dt><dd>".$row['module_id']."</dd><hr>";
      echo "<dt>Number of Complaints</dt><dd>".$row['number_of_complaints']."</dd><hr>";
      echo "<dt>Project Manager</dt><dd>".$pmanstatus."</dd><hr>";
      echo "</dl>";
     }

     /*if ($result->num_rows > 0) {
      echo "<table border='1'>";
      echo "    <tr>";
      echo "         <th> Engineer ID </th>";
      echo "         <th> Project ID </th>";
      echo "         <th> Module ID </th>";
      echo "         <th> Number of Complaints </th>";
      echo "         <th> Project Manager </th>";
      echo "    </tr>"; 
        while($row = $result->fetch_assoc()) {
          if($row['project_manager']=='y')
          {
               $pmanstatus = 'Yes';
          }
          else
          {
               $pmanstatus = 'No';
          }
               echo "<tr>";
               echo "<td>" . $row["id"]. "</td> <td>" . $row["project_id"]. "</td> <td>" . $row["module_id"]. "</td> <td>" . $row["number_of_complaints"]. "</td> <td>" . $pmanstatus . "</td>";
               echo "</tr>";
         }
     }*/ 
     else {
         echo "The selected Engineer ID may not exist anymore";
     }
?>