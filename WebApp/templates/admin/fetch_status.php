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
     echo "<table border='1'>";
     echo "    <tr>";
     echo "         <th> ID </th>";
     echo "         <th> Project ID </th>";
     echo "         <th> Module ID </th>";
     echo "         <th> Number of Complaints </th>";
     echo "         <th> Project Manager </th>";
     echo "    </tr>"; 

     $sql = "SELECT * FROM engineer WHERE id=$engineer_id";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
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
     } 
     else {
         echo "0 results";
     }
?>