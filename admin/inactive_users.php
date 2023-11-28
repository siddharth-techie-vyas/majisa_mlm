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

    <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script type="application/javascript" src="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></script>
    <script type="application/javascript">let table = new DataTable('#myTable');</script>
 

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
                        <h1 class="page-header">In-Active User(s) (With Regitered Mobile Number & Name)</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	
                	<table class="table" id="myTable">
                	    <thead>
                	        <tr>
                	            <th>S.no.</th>
                	            <th>Name / PIN</th>
                	            <th>Mobile</th>
                	            <th>Address</th>
                	            <th>Password</th>
                	            <th>Current Level</th>
                	            <th>Company Added Into</th>
                	            <th>Total User Under</th>
                	            <th>Total Reward(s) Per PIN</th>
                	            <tH>Registered On</tH>
                	            <th>Utility</th>
                	        </tr>
                	        <tbody>
                	            <?php 
                	            $counter=1;
                	                $query=mysqli_query($con,"SELECT * FROM user u INNER JOIN tree t on t.userid=u.pin GROUP BY t.userid HAVING COUNT(t.id)<10");
                	                //$query=mysqli_query($con,"SELECT COUNT(id) AS count,userid,level FROM `tree` GROUP BY userid HAVING COUNT(id)<10 ORDER BY id DESC ");
                	                while($row=mysqli_fetch_array($query))
                	                {
                	                    if($row['count']>1)
                	                    {$peruser = $row['count']*20;}
                	                    else
                	                    {$peruser = 0;}
                	                    $user=get_user($con,$row['userid']);
                	                    
                	                    //-- added on
                	                    $old_date_timestamp = strtotime($user['added_on']);
                                        $new_date = date('d-m-Y', $old_date_timestamp);  
                	                    
                	                    echo "<tr id=row".$row['userid'].">";
                	                    echo "<td>".$counter++."</td>";
                	                    echo "<td>".$row['userid'].' / '.$user['uname'];?>
                	                    <i class='fa fa-tree btn btn-sm btn-info' onclick="show_tree('<?php echo $row['userid'];?>')"></i>
                	                    </td><?php
                	                    echo "<td>".$user['mobile']."</td>";
                	                    echo "<td>".$user['address']."</td>";
                	                    echo "<td>".$user['password']."</td>";
                	                    echo "<td>".$user['current_level']."</td>";
                	                    echo "<td>".$row['level']."</td>";
                	                    echo "<td>".$row['count']."</td>";
                	                    echo "<td>".$peruser."</td>";
                	                    echo "<td>".$new_date."</td>";
                	                    ?><td><input type='button' class='btn btn-sm- btn-danger' value='Delete' onclick="delete_me('<?php echo $row['userid'];?>')"></td><?php
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
    
    function delete_me(id)
    {
        let text;
        if (confirm("Are You Sure To Delete This Account ?") == true) {
           $.ajax({
                type: 'get',
                url: 'php-includes/connect.php?function=delete_user&id='+id,
                success: function (result) {
                  $('#row'+id).hide(800);
                  alert(result);
                }
              });
        } else {}
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
