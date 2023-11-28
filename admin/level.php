<?php
include('php-includes/check-login.php');
require('php-includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mlml Website  - Level</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Level Managment</h1>
                        <?php if($_REQUEST['status']){?>
                            <div class='alert alert-success'>Level Updated Successfully !!!</div>
                        <?php }?>    
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<?php 
                        $level=mysqli_query($con, "select * from meta_data where metaname='level'");
                        $level=mysqli_fetch_array($level);
                        $nuoflevel=$level['value1'];
                        echo "<form name='level' method='post' action='level_managment.php'>";
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Level #</th>";
                        echo "<th>Number of User</th>";
                        echo "<th>Wining Amount</th>";
                        echo "</tr>";
                        echo "</thead>";
                        for($i=1;$i<=$nuoflevel;$i++)
                        {
                            //--- get data as per level
                            $level=mysqli_query($con,"select * from level where levelnu='$i'");
                            $level=mysqli_fetch_array($level);

                            echo "<tr>";
                            echo "<th>Level ".$i."<input type='hidden' name='levelnu[]' value='$i'></th>";
                            echo "<td><input type='number' name='nuofuser[]' value='$level[nuofuser]' class='form-control'></td>";
                            echo "<td><input type='number' name='amount[]' value='$level[amt]' class='form-control'></td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                        echo "<td colspan='3'><input type='submit' name='save_level' value='Save' class='btn btn-success'/></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</form>";
                    ?>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
