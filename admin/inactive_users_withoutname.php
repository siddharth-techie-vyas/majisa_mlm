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

    <title>Mlml Website  - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- data table-->
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">


 
 

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
                        <h1 class="page-header">In-Active User(s) (Without Regitered Mobile Number & Name)</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	
                	<table  id="example" class="display" style="width:100%">
                	    <thead>
                	        <tr>
                	            <th>S.no.</th>
                	            <th>Name / PIN</th>
                	            <th>Current Level</th>
                	            <th>Utility</th>
                	        </tr>
                	        <tbody>
                	            <?php 
                	            $counter=1;
                	                $query=mysqli_query($con,"SELECT * FROM `user` where mobile = '00000' ");
                	                while($row=mysqli_fetch_array($query))
                	                {
                	                    echo "<tr>";
                	                    echo "<td>".$counter++."</td>";
                	                    echo "<td>".$row['pin']." / ".$row['uname']."</td>";
                	                    echo "<td>".$row['current_level']."</td>";
                	                    echo "<td><input type='button' class='btn btn-sm- btn-danger' value='Delete' onclick='form_submit(".$row['pin'].")'></td>";
                	                    echo "</tr>";
                	                }
                	            ?>
                	        </tbody>
                	    </thead>
                	</table>
                    
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
    
    
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
new DataTable('#example');
</script>

<!-- Button trigger modal -->
<script>
    function show_tree(id)
    {
          $('.modal-body').html("<b>Loading response...</b>");
                    
               $.ajax({
                type: 'get',
                url: 'tree-view-admin.php?pin='+id,
                success: function (result) {
                    $('.modal-body').html(result);
                  $('#exampleModalLabel').html(id+' Tree View');
                }
              }); 
    }
</script>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>
