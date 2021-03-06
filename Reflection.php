<?php 
require_once "config.php";
session_start();
if(isset($_SESSION['username']  )){
  $username=$_SESSION['username'];
}
else{
  header("Location:Register.php");
}





 ?>

 <link rel="stylesheet" type="text/css" href="common.css">
         <div id="EmailContent">
                            <div class="TABLEMAINVIEW">
                              <div class="TABLECENTREVIEW">
                              <div>
                                 <table>
                                    <thead>
                                        <tr>
                                            <th>step1</th>
                                            <th>step2</th>
                                            <th>step3</th>
                                            <th>step4</th>
                                            <th>date</th>
                                            <th>datetime</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                     <?php

                                         if(isset($_SESSION['username'])){
                                          
                         $cutomerIDinfo  = mysqli_query($link,"select customerID  from  user_table where username ='$username' ");
                            
                                 if($row = mysqli_fetch_array($cutomerIDinfo)){
                                        $cutomer =$row['customerID'];
                                        echo $cutomer;
                                    }
                                }


                                         $activitiesQuery = mysqli_query($link,"SELECT * FROM reflection INNER JOIN user_table ON reflection.customerID=user_table.customerID where reflection.customerID='$cutomer'");

                                         while($row = mysqli_fetch_array($activitiesQuery)){
                                             
                                           ?>
                                             <tr>
                                           
                                            <td><?php echo$row['step1'] ;?></td>
                                            <td><?php echo$row['step2'] ;?></td>
                                            <td><?php echo$row['step3'] ;?>£</td>
                                            <td><?php echo$row['step4'] ;?></td>
                                            <td><?php echo$row['date'] ;?></td>
                                            <td><?php echo$row['datetime'] ;?></td>
                                        </tr>
                                         
                                      <?php
                                      }
                                      ?>
                                    </tbody>
                                 </table>
                              </div>
                          </div>
                             </div>
        </div>