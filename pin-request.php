<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$email = $_SESSION['userid'];
?>
<?php
//pin request 
if(isset($_GET['pin_request'])){
	$amount = mysqli_real_escape_string($con,$_GET['amount']);
	$date = date("y-m-d");
	$inv_nu = mysqli_real_escape_string($con,$_GET['inv_nu']);
	
	if($amount!=''){
		//Inset the value to pin request
		$query = mysqli_query($con,"insert into pin_request(`email`,`amount`,`date`,`inv_nu`) values('$email','$amount','$date','$inv_nu')");
		if($query){
			echo '<script>window.location.assign("pin-request.php?status=1");</script>';
		}
		else{
			//echo mysqli_error($con);
			echo '<script>window.location.assign("pin-request.php?status=2");</script>';
		}
	}
// 	else{
// 		echo '<script>alert("Please fill all the fields");</script>';
// 	}
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mlml Website  - Pin Request</title>

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
                        <h1 class="page-header">Pin Request</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-9">
                	    <?php 
                	        if(isset($_GET['status']))
                	        {
                	            if($_GET['status']=='1')
                	            {echo "<div class='alert alert-success'>Pin Request Sent Successfully !!!</div>";}
                	            if($_GET['status']=='2')
                	            {echo "<div class='alert alert-danger'>Something Went Wrong, Please Try gain Later !!!</div>";}
                	        }
                	    ?>
                    	<form method="get">	
                        	<div class="col-sm-4">
                            	<label>ID(s)</label>
                                <!--<input type="text" name="amount" class="form-control" required>-->
                                <select class="form-control" name="amount" required>
                                    <?php 
                                        for($i=1; $i<=10;$i++)
                                        {
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                        for($i=2; $i<=10;$i++)
                                        {
                                            $m=$i*10;
                                            echo "<option value='$m'>".$m."</option>";
                                        }
                                        for($i=3; $i<=10;$i++)
                                        {
                                            $m=$i*50;
                                            echo "<option value='$m'>".$m."</option>";
                                        }
                                        
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                            	<label>Invoice Number</label>
                            	<input type="text" name="inv_nu" value="" class="form-control" required>
                            </div>
                            <div class="col-sm-2"><br>
                            	<input type="submit" name="pin_request" class="btn btn-primary" value="Pin Request">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-9">
                    	<br><br>
                    	<table class="table table-bordered table-striped">
                        	<tr>
                            	<th>S.n.</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Invoice #</th>
                                <th>Status</th>
                                <th>Remark</th>
                            </tr>
                            <?php 
							$i=1;
							$query = mysqli_query($con,"select * from pin_request where email='$email' order by id desc");
							if(mysqli_num_rows($query)>0){
								while($row=mysqli_fetch_array($query)){
									$amount = $row['amount'];
									$date = date("d-m-Y", strtotime($row['date']));
									$status = $row['status'];
									$inv_nu = $row['inv_nu'];
									$remark = $row['remark'];
								?>
                                	<tr>
                                    	<td><?php echo $i; ?></td>
                                        <td><?php echo $amount; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $inv_nu; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $remark; ?></td>
                                    </tr>
                                <?php
									$i++;
								}
							}
							else{
							?>
                            	<tr>
                                	<td colspan="4">You have no pin request yet.</td>
                                </tr>
                            <?php
							}
							?>
                        </table>
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
