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

 <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    
<script>
  function get_slab(count)
    {
             var count = count;
             
             for(let i = 0; i <= count.length; i++)
             {
               var pin = document.getElementById("pin"+i).textContent;
              // alert(pin);
              
              $.ajax({
                type: 'get',
                url: 'php-includes/connect.php?function=get_slab_amt&pin='+pin,
                success: function(result) 
                {
                    $('#result'+i).html(result);
                    
                }
              }); 
              
             }
    }
</script>

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
                        <h1 class="page-header">Slam Amount Allotment</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                  
                	               
                	
                	<table class="table" id="example">
                	    <thead>
                	        <tr>
                	            <th>S.no.</th>
                	            <th>Name / PIN</th>
                	            <th>Current Level</th>
                	            <th>View Tree</th>
                	            <th>Company Added Into</th>
                	            <th>User Under</th>
                	            <th>Reward(s) Per PIN</th>
                	            <th>Slab Amt <small>(Auto Calculation)</small></th>
                	            <th>Slab Allot</th>
                	           
                	        </tr>
                	        <tbody>
                	              <?php 
                	                $counter=0;
                	                 $query=mysqli_query($con,"SELECT * FROM user u INNER JOIN tree t on t.userid=u.pin GROUP BY t.userid HAVING COUNT(t.id) >=10 ");
                	               
                	               //$query=mysqli_query($con,"SELECT COUNT(id) AS count,userid,level FROM tree GROUP BY userid HAVING COUNT(id)>=10");
                	                $count=mysqli_num_rows($query);
                	                
                	                while($row=mysqli_fetch_array($query))
                	                {
                	                    $tree = mysqli_query($con,"select COUNT(id) AS count from tree where userid='".$row['pin']."' ");
                	                    $tree0=mysqli_fetch_array($tree);
                	                    if(mysqli_num_rows($tree)>0)
                	                    {$peruser = $tree0['count']*20;}
                	                    else
                	                    {$peruser=0;}
                	                    
                	                    
                	                    echo "<tr>";
                	                    echo "<td>".$counter."</td>";
                	                    echo "<td id='pin$counter'>".$row['pin']."</td>";
                	                    echo "<td>".$row['current_level']."</td>";
                	                    ?><td><a href='javascript:void(0)' onclick="show_tree('<?php echo $row['pin'];?>')" class='btn btn-info btn-xs' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-tree'></i></a></td><?php
                	                    echo "<td>".$row['level']."</td>";
                	                    echo "<td>".$tree0['count']."</td>";
                	                    echo "<td>".$peruser."</td>";
                	                    echo "<td><span  id='result$counter'><img src='../images/loading.gif' width='30' height='auto'></span></td>";
                	                    ?>
                	                    <td id="formtd<?php echo $counter;?>">
                	                        <?php 
                	                        $check_slab_amt=get_slab_amt_user($con,$row['pin'],$row['current_level']);
                	                        if($check_slab_amt==true)
                	                        {echo "Slab Amount Already Given";}
                	                        else
                	                        {
                	                        ?>
                	                        <form name="slab_amt" id="slab_form<?php echo $counter;?>" method="get">
                    	                        <!--<input type='text' name="amt" id="amt<?php echo $counter;?>">-->
                    	                        <select name="amt" id="amt<?php echo $counter;?>">
                    	                            <option disabled='disabled' selected='selected'>-- Select --</option>
                    	                           <?php 
                    	                           $query=mysqli_query($con,'select * from level');
                    	                           while($row=mysqli_fetch_array($query))
                    	                           {
                    	                               echo "<option value='".$row['amt']."'>".$row['amt']."</option>";
                    	                           }
                    	                           ?>     
                    	                        </select>
                    	                        <input type="hidden" name="level" id="level<?php echo $counter;?>" value="<?php echo $row['current_level']; ?>"/>
                    	                        <input type="hidden" name="pin" id="upin<?php echo $counter;?>" value="<?php echo $row['pin']; ?>"/>
                    	                        <button type='button' class='btn btn-xs btn-primary' onclick="form_submit('<?php echo $counter;?>')">
                    	                            Send Slab <i class='fa fa-inr'></i>
                    	                        </button>
                	                        </form>
                	                        <?php }?>
                	                    </td><?php
                	                    echo "</tr>";
                	                    $counter++;
                	                }
                	            ?>
                	        </tbody>
                	    </thead>
                	</table>
                     <script>get_slab('<?php echo $count;?>');</script>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
    
    function form_submit(id)
    {
            var level=$('#level'+id).val();
            var amt=$('#amt'+id).val();
            var pin=$('#upin'+id).val();
           
            
            $.ajax({
                type: 'get',
                url: 'php-includes/connect.php?function=save_slab_amt&level='+level+'&amt='+amt+'&pin='+pin,
                success: function (result) {
                    $('#formtd'+id).html('<img src="../images/loading.gif">');
                    $('#slab_form'+id).hide(500);
                    $('#formtd'+id).html(result);
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
