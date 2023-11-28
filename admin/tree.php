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
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">

<!--<div class="col-sm-6">-->
<!--    <h4>Your Level</h4>-->
<!--        <div class="card" style="width: 35rem; border:1px solid #d8d8d8; padding:15px; border-radius:5%;">-->
<!--        <img class="card-img-top" src="../images/user-level.jpg" alt="majisa industries" style="height:auto; width:100%;">-->
<!--        <div class="card-body">-->
<!--        <h2 class="card-title">Your Level Is <span class="badge badge-warning" style="font-size:25px;"><?php echo $_SESSION['level']-1;?></span></h2>-->
<!--        <p class="card-text">Improve your level by adding more members quickly, and get a change to win more comission. Your next level will be <span class="badge badge-warning" ><?php echo $_SESSION['level'];?></span></p>-->
<!--        <a href="tree-total.php" class="btn btn-primary">View Members Under You</a>-->
<!--        </div>-->
<!--        </div>-->
<!--</div>-->

<!--<div class="col-sm-6">-->
<!--    <h4>Company Level</h4>-->
<!--    <div class="card" style="width:35rem; border:1px solid #d8d8d8; padding:15px; border-radius:5%;">-->
<!--        <img class="card-img-top" src="../images/company-level.jpg" alt="Majisa Industries" style="height:auto; width:100%;">-->
<!--        <div class="card-body">-->
<!--         <h2 class="card-title">Company Level Is <span class="badge badge-warning" style="font-size:25px;"><?php $clevel=mysqli_query($con, "select * from user where id='1'"); $row=mysqli_fetch_array($clevel); echo $row['current_level']-1;?></span></h2>-->
<!--        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
        
<!--        </div>-->
<!--        </div>-->
<!--</div>-->


<div class='col-sm-5'>
    <img class="card-img-top" src="../images/company-level.jpg" alt="Majisa Industries" style="height:auto; width:100%;">

<div class="col-lg-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="panel-title">Total User Added In Company At</h4>
</div>
<div class="panel-body">
<?php 
echo  get_total_user($con);
?>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">Your Active Added Member(s)</h4>
</div>
<div class="panel-body">
<?php 
echo  get_active_user($con);
?>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="panel panel-danger">
<div class="panel-heading">
<h4 class="panel-title">Your In-Active Added Member(s)</h4>
</div>
<div class="panel-body">
<?php 
echo  get_inactive_user($con);
?>
</div>
</div>
</div>

                    
</div>
<div class='col-sm-7'>
    <?php 
    //--  get level tree
    $level = mysqli_query($con,"select * from level");
    while($lrow=mysqli_fetch_array($level)){
    
        $amount = $lrow['amt'];  
       
        $amount = money_format('%!i', $amount); 
    ?>
        <input type='button' class='btn btn-success' value='<?php echo 'Level :- '.$lrow['levelnu'];?>'>
        <span class='badge badge-primary'><i class='fa fa-inr'></i> <?php echo $amount;?></span>
        <?php 
        $yourlevel = get_user($con,$_SESSION['userid']);
        $yourlevel = $yourlevel['current_level'];
        if($lrow['levelnu']==$yourlevel){
        ?>
        <img src="../images/you.gif" style="width:auto; height:30px;"/> <b>You Are Here</b>
        
       
        <?php }
        $company = get_company_level($con);
        if($lrow['levelnu']==$company){
        ?>
        <img src="../images/company.gif" style="width:auto; height:30px;"/> <b>Company Is Here</b>
        <?php }?>
        
        <?php $count=get_user_in_level($con,$lrow['levelnu']);
        if($count>0){?>
        <a href='#' class='btn btn-info btn-sm'> <?php echo $count?> Members</a>
        <?php } ?>
        
        
        <hr>
    <?php }
    ?>
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