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

    <title>Mlml Website  - SLAB</title>

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
                        <h1 class="page-header">SLAB Managment</h1>
                        <?php if($_REQUEST['status']){?>
                            <div class='alert alert-success'>SLAB Updated Successfully !!!</div>
                        <?php }?>    
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<?php 
                        $level=mysqli_query($con, "select * from meta_data where metaname='slab'");
                        $level=mysqli_fetch_array($level);
                        $nuofslab=$level['value1'];
                        echo "<form name='level' method='post' action='slab_managment.php'>";
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Slab</th>";
                        for($i=1;$i<=$nuofslab;$i++)
                        {
                        echo "<th>Comission $i</th>";
                        }
                        echo "</tr>";
                        
                        echo "</thead>";
                        for($i=1;$i<=$nuofslab;$i++)
                        {
                           //--- get data as per level
                            $level=mysqli_query($con,"select * from slab where level='$i'");
                            $level=mysqli_fetch_array($level);
                            
                            echo "<tr>";
                            echo "<th>".$i."<input type='hidden' name='slabnu[]' value='$i'></th>";
                            for($j=1;$j<=$nuofslab;$j++)
                            { 
                            echo "<td><input type='number' name='".$i."amount[]' value='".$level['col'.$j]."' class='form-control'></td>";
                            }
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
