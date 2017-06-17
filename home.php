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
              <!--tree-->
              <div class="col-md-2 col-sm-12">
                   <?php include './user-menu.php';?>
              </div> 
              <!--/tree-->
            <div class="col-md-10 col-sm-12">Container
            
            
            </div>
        </div>
        
        
        
    </body>
</html>
