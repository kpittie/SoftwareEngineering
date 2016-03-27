<?php

						$dbhost = 'localhost';
						$dbuser = 'root';
						$dbpass = '';
						$dbname = 'cmt';

                                                 
                                                  $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
                                                                                                                

                                                    $name= $_POST["proj_name"];

                                                   $sql = "SELECT id FROM project WHERE name='$name'";
	                                           $result = $conn->query($sql);
	                                           $ide = $result->fetch_assoc();
	                                           $id = $ide["id"];

                                                   $sql = "SELECT * from  module where project_id ='$id '";         
                                                  $result = $conn->query($sql);


                                             echo "<select name='DROP DOWN NAME'>"; 

                                          while ($row = mysqli_fetch_array($result)) {
                                             echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                                     }      

                                               echo '</select>';
                                                
						$conn->close();
				?>