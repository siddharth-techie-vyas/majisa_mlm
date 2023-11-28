<?php
include('php-includes/check-login.php');
require('php-includes/connect.php');
?>
<?php
// if(isset($_GET['userid'])){
// 	$userid = mysqli_real_escape_string($con,$_GET['userid']);
// 	$amount = mysqli_real_escape_string($con,$_GET['amount']);
	
// 	$date = date("Y-m-d");
	
// 	$query = mysqli_query($con,"insert into income_received(`userid`, `amount`, `date`) value('$userid', '$amount', '$date')");
	
// 	$query = mysqli_query($con,"update income set current_bal=0 where userid='$userid'");
	
// 	echo '<script>alert("Payment has paid");window.location.assign("income.php");</script>';
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mlml Website  - Income</title>

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
                        <h1 class="page-header">Bulk Registration(s)</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                    	   
                        	<table class="table table-bordered table-striped">
                            	<thead>
                                	<tr>
                                    	<th>Select User</th>
                                        <th>
                                            <select name="username" id="pinlist"  class="form-control" >
                                                <option disabled="diasbled" selected="selected">-- Select User --</option>
                                                <?php 
                                                    $pin_user=mysqli_query($con,"Select count(*) AS id, userid from pin_list where status = 'open' group by userid");
                                                    while($row=mysqli_fetch_array($pin_user))
                                                    {
                                                        echo "<option value='".$row['id']."'>".$row['userid']." (".$row['id'].")</option>";
                                                    }
                                                ?>
                                            </select>
                                        </th>
                                        <th>Nu Of ID's</th>
                                        <td>
                                            <select name='count' id='count' class='form-control'>
                                                <?php 
                                        for($i=1; $i<=10;$i++)
                                        {
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                        for($i=2; $i<=5;$i++)
                                        {
                                            $m=$i*10;
                                            echo "<option value='$m'>".$m."</option>";
                                        }
                                        
                                        
                                    ?>
                                                </select>
                                        </td>
                                        <td><input type='button' name='submit' value='View List' class='btn btn-warning' onclick="get_append()">
                                    </tr>
                                </thead>
                                
                            </table>
                            
                            
                            
                            
                            <form name="bulk_reg" action="get_bulk_pin.php" id="bulk_pin_form" method="get">
                            <div id="pin_reg0" class="col-lg-12"></div>
                            <div id="pin_reg" class="col-lg-12"></div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
   
    
   function get_append()
     {
          
        $('#pin_reg').html("<b>Loading response...</b>");
        var userid = $('#pinlist').find(":selected").text();
        var count = $('#count').val();
                
                
           $.ajax({
            type: 'get',
            url: 'get_bulk_pin.php',
            data: {userid:userid, count:count},
            success: function (result) {
              $('#pin_reg').html(result);
            }
          });
    }
    
    function generate_member()
    {
        var formdata = $('#bulk_pin_form').serializeArray();
        
      $('#pin_reg0').html("<b>Loading response...</b>");
                $('#pin_reg').html('');
           $.ajax({
            type: 'get',
            url: 'get_bulk_pin.php',
            data: formdata,
            success: function (result) {
                $('#pin_reg0').html('');
              $('#pin_reg').append(result);
            }
          });  
    }
    
</script>
</body>

</html>
