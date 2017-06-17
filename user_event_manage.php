<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
   <?php
    session_start();
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
      
        <div class="row">
            <div class="col-md-12">Head</div>
        </div>
        <div class="row">
            <div class="col-md-12">Status</div>
        </div>
               <div class="row">
                        <div class="col-md-2">
                            <?php include './user-menu.php'; ?>                            
                        </div>
                        <div class="col-md-10">



                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Description</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    include_once './_function.php';
                                    // Create connection
                                    $conn = getDBConnection();
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    $userid = $_SESSION['user_id'];
                                    
                                    $sql = '';
                                    
                                    if($_SESSION['user_role']=='ADM'){
                                    $sql = " SELECT * FROM event_ati  ORDER BY id DESC";
                                    }else{
                                    $sql = " SELECT * FROM event_ati WHERE userid = $userid  ORDER BY id DESC";
                                    }
                                    
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                    <tr>
                                        <td><?php echo $row["eventname"]?></td>
                                        <td><?php echo $row["description"]?></td>
                                        <?php  
                                        if($_SESSION['user_role']=='ADM'){
                                         ?>
                                        <td><a href="user_event_photo_authorize.php?id=<?php echo $row["id"];?>">Manage</a></td>
                                        <?php
                                        }else{
                                         ?>
                                        <td><a href="user_event_photo.php?id=<?php echo $row["id"];?>">Manage</a></td>
                                        <?php   
                                        }
                                        
                                        ?>
                                        <td></td>
                                    </tr>
                                    <?php
                                    }
                                    } else {
                                    echo "0 results";
                                    }

                                    mysqli_close($conn);
                                    ?>

                                </tbody>
                            </table>











                        </div>
                    </div>
        
        
        
    </body>
</html>
