<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$email = $_SESSION['userid'];
?>
<?php
//pin request 
if(isset($_POST['save'])){
	$bank_name = mysqli_real_escape_string($con,$_POST['bank_name']);
	$ac_nu = mysqli_real_escape_string($con,$_POST['ac_nu']);
	$ifsc = mysqli_real_escape_string($con,$_POST['ifsc']);
	$upi = mysqli_real_escape_string($con,$_POST['upi']);
	
    		$query=mysqli_query($con,"update user SET email='".$email."',uname='".$name."',address='".$address."',mobile='".$mobile."' where pin='".$_SESSION['userid']."' ");
			echo '<script>window.location.assign("profile.php?status=1");</script>';
		
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

    <title>Mlml Website  - Profile</title>

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
                        <h1 class="page-header">Update Profile</h1>
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
                	            {echo "<div class='alert alert-success'>Profile Updated Successfully & Data Will Be Refresh From Next Login!!!</div>";}
                	            if($_GET['status']=='2')
                	            {echo "<div class='alert alert-danger'>Something Went Wrong, Please Try gain Later !!!</div>";}
                	        }
                	    ?>
                    	<form method="post">	
                        	<div class="col-sm-4">
                            	<label>USER PIN</label>
                                <input type="text" name="pin" value="<?php echo $_SESSION['userid']?>" class="form-control" readonly="readonly">
                                
                            </div>
                        	<div class="col-sm-4">
                            	<label>Bank Name</label>
                                <input type="text" name="bank_name" value="<?php echo $_SESSION['bank_name'];?>" class="form-control" required>
                                
                            </div>
                            <div class="col-sm-4">
                            	<label>IFSC</label>
                                <input type="text" name="ifsc" value="<?php echo $_SESSION['ifsc'];?>" class="form-control" required>
                                
                            </div>
                            <div class="col-sm-4">
                            	<label>Ac Number</label>
                            	<input type="text" name="ac_nu" value="<?php echo $_SESSION['ac_nu'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-4">
                            	<label>UPI</label>
                            	<input type="text" name="upi" value="<?php echo $_SESSION['upi'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-2"><br>
                            	<input type="submit" name="save" class="btn btn-primary" value="Update Profile">
                            </div>
                        </form>
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
