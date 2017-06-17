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
              <div class="row">
                        <div class="col-md-2">
                            <?php include './user-menu.php'; ?>
                        </div>
                        <div class="col-md-10">

                            <?php
                            if (isset($_POST['btnCreate'])) {


                                $eventname = $_POST['eventname'];
                                $description = $_POST['description'];
                                $userid = $_SESSION['user_id'];
                                $atiid = $_SESSION['user_ati'];

                                include_once './_function.php';
                                // Create connection
                                $conn = getDBConnection();
// Check connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = " INSERT INTO event_ati 
            (`eventname`,
             `description`,
             `userid`,
             `atiid`)
VALUES ('$eventname',
        '$description',
        '$userid',
        '$atiid'); ";

                                if (mysqli_query($conn, $sql)) {
                                    echo "New Event created successfully, ready to upload image files";
                                    $last_id = mysqli_insert_id($conn);
                                    //create new folder in directory
                                    $atiname = $_SESSION['user_atiname'];

//                                    $dir = '/uploads/'.$atiname.'/'.$last_id;
//                                    echo $dir;

                                    mkdir('uploads/' . $atiname . '/' . $last_id);


                                    //redirecting 

                                    mysqli_close($conn);
                                    header("Location: user_event_photo.php?id=".$last_id);
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }



                                mysqli_close($conn);




//                                header("Location: user_event_photo.php"); /* Redirect browser */
                                //create and event 
                            }
                            ?>

                            <form class="form-horizontal" action="" method="POST">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" name="eventname" placeholder="Name of the event"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control">
                                            
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="btnCreate" class="btn btn-primary">create</button>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
        </div>
        
        
        
    </body>
</html>
