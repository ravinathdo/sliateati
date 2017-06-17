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
                            $atiname;
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




                            if (isset($_GET['tostatus'])) {
                                //update the statuscode
                                $epid = $_GET['epid'];
                                $tostatus = $_GET['tostatus'];
                                
                                
                                $sql = "UPDATE photo_event SET statuscode=$tostatus WHERE id= $epid ";
                             
                                if (mysqli_query($conn, $sql)) {
                                    echo "Record updated successfully";
                                } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                }
                            }



                            $sql = "  SELECT event_ati.*,ati.atiname FROM event_ati INNER JOIN ati 
        ON event_ati.atiid = ati.id
        WHERE  event_ati.id = $id AND event_ati.statuscode = 'ACT' ";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <div class="bs-callout bs-callout-info" id="callout-focus-demo"> 
                                        <h4><?php echo $row['eventname'] ?></h4>
                                        <p><?php echo $row['description'] ?></p> 
        <?php $atiname = $row['atiname']; ?>
                                        <p><?php echo $atiname ?></p> 
                                        <?php $eventid = $row['id']; ?>
                                    </div>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
//                            mysqli_close($conn);
                                ?>



                            <h4></h4>
                            <div class="bs-callout bs-callout-info bg-danger  " id="callout-type-b-i-elems">
                                <h4>Pending Authorize uploads</h4>

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
                                        <a href="user_event_photo_authorize.php?id=<?php echo $id ?>&epid=<?php echo $row['id'] ?>&tostatus='ACT'"><i class="fa fa-check" aria-hidden="true"></i></a>
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

                            <div class="bs-callout bs-callout-info bg-success" id="callout-type-b-i-elems" >
                                <h4>Authorized uploads</h4>
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
                                        <a href="user_event_photo_authorize.php?id=<?php echo $id ?>&epid=<?php echo $row['id'] ?>&tostatus='DACT'"><i class="fa fa-window-close" aria-hidden="true"></i></a>
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
