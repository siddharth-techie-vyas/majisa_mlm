<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
$search = $userid;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Mlml Website - Tree</title>
<!-- Bootstrap Core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- custom-->
<style>
h5{background:#8F9779; display:block; border-bottom:1px solid #4D5D53; padding:5px 0 5px 0; color:#FFF;}
.userlist li{float: left; list-style:none; margin:3px; padding:5px; border:1px solid; font-size:15px;}
    .userlist li a{
        display: block;
  color: #FFF;
  text-align: center;
  padding: 5px;
  text-decoration: none;
    }
    .userlist li a:hover{color:red; font-style: italic;}
</style>
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
<h1 class="page-header">Tree</h1>
<span class='btn btn-success '>Active</span>&nbsp;<span class='btn btn-danger'>In-Active</span>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-lg-12 text-center">
    <h5>Level 0</h5>
    <ul class='userlist'>
        <li class='btn btn-info'><?php if(isset($_GET['pin'])){echo 'M'.$_GET['pin'];}else{echo $_SESSION['userid'];}?></li>
        </ul>
</div>


<?php 

$start='0';
$limit='10';
$level0 = mysqli_query($con,"select * from level where levelnu > 1");
while($row=mysqli_fetch_array($level0)){
?>    
<div class="col-lg-12 text-center">
    <h5>Level <?php echo $row['levelnu']-1;?></h5>
    <ul class='userlist'>
    <?php 
        // --- check user availble in level or not  and set automatically in list
        if(isset($_GET['pin']))
        {$levelcount=mysqli_query($con,"select * from tree where userid='M".$_GET['pin']."' LIMIT $start, $limit");}
        else
        {$levelcount=mysqli_query($con,"select * from tree where userid='".$_SESSION['userid']."' LIMIT $start, $limit"); 
            
           // echo "select * from tree where userid='".$_SESSION['userid']."' LIMIT $start, $limit";
        }
        if(mysqli_num_rows($levelcount)<1)
        {echo "No Member Found"; exit(); }
        while($row0=mysqli_fetch_array($levelcount)){ 
            $count_user=get_user_count_under($con,'M'.$row0['pin']);
            if($count_user >= 10){$bg='btn btn-success';}
            else{$bg='btn btn-danger';}
            echo "<li class='$bg'><a href='tree-total.php?pin=".$row0['pin']."'><i class='fa fa-user fa-1x'> M".$row0['pin']."</i></a></li>";
        }
        
        $start=$row['nuofuser'];
        $limit=$row['nuofuser']*10;
    ?>
    </ul>
</div>
<?php }?>

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