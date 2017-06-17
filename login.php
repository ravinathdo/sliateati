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
        <script src="js/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-4">.col-md-1</div>
            <div class="col-md-4" style="margin-top: 25px">
              <!--<center><img src="images/sliate-logo.png" style="width:129px;height:171px"  /></center>-->
              <h4>Login</h4>
              <form class="form-horizontal" action="login.php" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="username" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="btnLog" class="btn btn-primary">Sign in</button>
                        </div>
                    </div>
                </form>
            <?php
                if (isset($_POST['btnLog'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Create connection
                    include './_function.php';
                    $conn = getDBConnection();
// Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    //SELECT * FROM user_tbl WHERE username = 'a' AND pword = PASSWORD('a') AND statuscode = 'ACT'
                    $sql = "SELECT * FROM user_tbl WHERE username = '" . $_POST['username'] . "' AND pword = PASSWORD('" . $_POST['password'] . "') AND statuscode = 'ACT'";
                    
                    
                    $sql = "   SELECT user_tbl.*,ati.atiname FROM user_tbl INNER JOIN ati
        ON  user_tbl.ati = ati.id  WHERE user_tbl.username = '" . $_POST['username'] . "' AND user_tbl.pword = PASSWORD('" . $_POST['password'] . "') AND user_tbl.statuscode = 'ACT'";
                    
                    //echo 'sql:'.$sql;
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $_SESSION['user_id'] = $row["id"];
                            $_SESSION['user_username'] = $row["username"];
                            $_SESSION['user_role'] = $row["rolecode"];
                            $_SESSION['user_firstname'] = $row["firstname"];
                            $_SESSION['user_lasttname'] = $row["lastname"];
                            $_SESSION['user_ati'] = $row["ati"];
                            $_SESSION['user_atiname'] = $row["atiname"];

//                                header("Location:home.php");
                            header("Location: home.php"); /* Redirect browser */
                        }
                    } else {
                        ?>
                        <div class="msgCenter">
                            <p class="bg-danger">Invalid username or password</p>
                        </div>
                        <?php
                    }

                    mysqli_close($conn);
                }
                ?> 
            </div>
            <div class="col-md-4">.col-md-1</div>
        </div>
        
        
        
         
              
        
        
    </body>
</html>
