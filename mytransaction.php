<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mlml Website  - My Transaction(s)</title>

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
                        <h1 class="page-header">My Transaction(s)</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	 <table class="table" align="center" border="0" style="text-align:center">
                             	<thead>
                             	    <tr>
                             	        <th>S.No.</th>
                             	        <th>Date</th>
                             	        <th>Amount</th>
                             	        <th>Transaction</th>
                             	    </tr>
                             	</thead>
                             	<tbody>
                             	    <?php 
                             	    $counter=1;
                             	    $query=mysqli_query($con,"select * from transaction where pin='".$_SESSION['userid']."' ");
                             	    while($row=mysqli_fetch_array($query)){?>
                             	    <tr>
                             	        <th><?php echo $counter++;?></th>
                             	        <td><?php $old_date_timestamp = strtotime($row['datetime']); echo date('d-m-Y H:i:s', $old_date_timestamp); ;?></td>
                             	        <td><?php echo $row['amount'];?></td>
                             	        <td><?php echo $row['remark'];?></td>
                             	    </tr>
                             	    <?php }?>
                             	</tbody>
                             </table>
                        </div>
                    </div>
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
