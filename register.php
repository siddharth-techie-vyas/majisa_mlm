<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    

</head>

<body class=" bg-primary">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">

                    <center><img src="http://www.majisaindustries.in/theme/img/logo.png" width="auto" height="80"></center>
                    <div class="panel-heading">
                        <h3 class="panel-title">User Registration - User Panel</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            if(isset($_GET['status']))
                            {
                                if($_GET['status']=='0')
                                {
                                    echo "<div class='alert alert-danger'>Mobile Number Is Already Registered !!! </div>";
                                }
                                if($_GET['status']=='1')
                                {
                                    echo "<div class='alert alert-success'>You are registered successfully. Password has been send to your registered mobile number !!! </div>";
                                }
                                if($_GET['status']=='2')
                                {
                                    echo "<div class='alert alert-warning'>Something went wrong, Please try again later !!! </div>";
                                }
                                if($_GET['status']=='3')
                                {
                                    echo "<div class='alert alert-warning'>Please Enter A Valid Mobile Number !!! </div>";
                                }
                                
                            }
                        ?>
                        <form method="post" action="register_save.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mobile Number" name="mobile" type="number" autofocus>
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <input class="form-control" placeholder="E-mail" name="email" type="text" >-->
                                <!--</div>-->
                                <div class="form-group">
                                    <input class="form-control" placeholder="Address" name="address" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Name" name="name" type="text" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit"  class="btn btn-lg btn-success btn-block">Register</button>
                                
                                <a href="index.php" class="btn btn-lg btn-warning btn-block"> << Back to Login</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
