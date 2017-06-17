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


                            <?php
                            $id = $_GET['id'];
                            $userid = $_SESSION['user_id'];
                            $eventid;
                            //get available images
                            //SELECT * FROM event_ati WHERE  id = 1 AND userid = 1 AND statuscode = 'ACT' 
                            // Create connection
                            include_once './_function.php';
                            $conn = getDBConnection();
// Check connection
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $sql = "SELECT * FROM event_ati WHERE  id = $id AND userid = $userid AND statuscode = 'ACT' ";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <div class="bs-callout bs-callout-info" id="callout-focus-demo"> 
                                        <h4><?php echo $row['eventname'] ?></h4>
                                        <p><?php echo $row['description'] ?></p> 
                                        <?php $eventid = $row['id'] ?>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
//                            mysqli_close($conn);
                            ?>





                            <?php
                            if (isset($_POST['btnUpload'])) {





                                $target_dir = 'uploads/' . $_SESSION['user_atiname'] . '/' . $eventid . '/';
                                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
                                if (isset($_POST["submit"])) {
                                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                    if ($check !== false) {
                                        echo "File is an image - " . $check["mime"] . ".";
                                        $uploadOk = 1;
                                    } else {
                                        echo "File is not an image.";
                                        $uploadOk = 0;
                                    }
                                }
// Check if file already exists
                                if (file_exists($target_file)) {
                                    echo "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
// Check file size
                                if ($_FILES["fileToUpload"]["size"] > 500000) {
                                    echo "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }
// Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "JPG" 
                                        && $imageFileType != "png" && $imageFileType != "PNG" 
                                        && $imageFileType != "jpeg" && $imageFileType != "JPEG"
                                        && $imageFileType != "gif" && $imageFileType != "GIF") {
                                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
// Check if $uploadOk is set to 0 by an error
                                if ($uploadOk == 0) {
                                    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
                                } else {
                                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                        echo "<p class=\"bg-success\">The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded</p>";
                                        //insert into database 
                                        $imgName = basename($_FILES["fileToUpload"]["name"]);

                                        $photopath = $_SESSION['user_atiname'] . '/' . $eventid . '/' . $imgName;

                                        echo 'ImageName:' . $photopath;
                                        include_once './_function.php';
                                        $conn = getDBConnection();
// Check connection
                                        if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }

                                        $atiname = $_SESSION['user_atiname'];
                                        $sql = "   INSERT INTO photo_event
            (`photopath`,
             `userid`,
             `statuscode`,
             `atiname`,
             `eventid`)
VALUES ('$photopath',
        '$userid',
        'PND',
        '$atiname',
        '$eventid'); ";

                                        if (mysqli_query($conn, $sql)) {
                                            echo "Image Uploaded";
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }

                                        mysqli_close($conn);
                                    } else {
                                        echo "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }
                            ?>

                            <form class="form-inline" action="user_event_photo.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Photo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Photo</div>
                                        <input type="file" class="form-control" id="exampleInputAmount" name="fileToUpload" id="fileToUpload" />
                                    </div>
                                </div>
                                <button type="submit" name="btnUpload" class="btn btn-primary">Upload</button>
                            </form>

                            <h4></h4>
                            <div class="bs-callout bs-callout-info bg-success" id="callout-type-b-i-elems">
                                <h4>Authorized uploads</h4>

                                <?php
                                $conn = getDBConnection();
// Check connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = " SELECT * FROM photo_event WHERE eventid = $eventid AND statuscode = 'PND' ";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <img src="uploads/<?php echo $row['photopath'] ?>" alt="..." class="img-thumbnail img-upload"/>
                                        <a href=""><i class="fa fa-window-close" aria-hidden="true"></i></a>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($conn);
                                ?>


                            </div>
                            <h4></h4>
                            <h4></h4>
                            <div class="bs-callout bs-callout-info bg-danger" id="callout-type-b-i-elems" >
                                <h4>Pending Authorize uploads</h4>
                                <?php
                                $conn = getDBConnection();
// Check connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = " SELECT * FROM photo_event WHERE eventid = $eventid AND statuscode = 'ACT' ";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <img src="uploads/<?php echo $row['photopath'] ?>" alt="..." class="img-thumbnail img-upload"/>
                                        <a href=""><i class="fa fa-window-close" aria-hidden="true"></i></a>
                                            <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    mysqli_close($conn);
                                    ?>
                            </div>





                        </div>
                    </div>
        
        
        
    </body>
</html>
