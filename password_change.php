<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$email = $_SESSION['userid'];
?>
<?php
//pin request 
if(isset($_POST['save'])){
	$current_pass = mysqli_real_escape_string($con,$_POST['old_pass']);
	$new_pass = mysqli_real_escape_string($con,$_POST['new_pass']);
	
		//Inset the value to pin request
		$query = mysqli_query($con,"select * from user where pin='".$email."' ");
		$row=mysqli_fetch_array($query);
		if($current_pass!=$row['password']){
			echo '<script>window.location.assign("password_change.php?status=2");</script>';
		}
		else{
			$query=mysqli_query($con,"update user SET password='".$new_pass."' where pin='".$email."' ");
			echo '<script>window.location.assign("password_change.php?status=1");</script>';
		}
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

    <title>Mlml Website  - Change Password</title>

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
                        <h1 class="page-header">Change Password</h1>
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
                	            {echo "<div class='alert alert-success'>Password Changed Successfully !!!</div>";}
                	            if($_GET['status']=='2')
                	            {echo "<div class='alert alert-danger'>Something Went Wrong, Please Try gain Later !!!</div>";}
                	        }
                	    ?>
                    	<form method="post">	
                        	<div class="col-sm-4">
                            	<label>Old Password</label>
                                <input type="text" name="old_pass" class="form-control" required>
                                
                            </div>
                            <div class="col-sm-4">
                            	<label>New Password</label>
                            	<input type="text" name="new_pass" value="" class="form-control" required>
                            </div>
                            <div class="col-sm-2"><br>
                            	<input type="submit" name="save" class="btn btn-primary" value="Change Password">
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
