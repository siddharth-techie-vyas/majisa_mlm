<?php
session_start();
require('php-includes/connect.php');
$email = mysqli_real_escape_string($con,$_POST['email']);
$password = mysqli_real_escape_string($con,$_POST['password']);

//$query = mysqli_query($con,"select * from user where email='$email'  and password='$password'");


$query = mysqli_query($con,"select * from user where '$email' IN (pin,email)  and password='$password'");
$row=mysqli_fetch_array($query);

if(mysqli_num_rows($query)>0){
	$_SESSION['userid'] = $row['pin'];
	$_SESSION['level'] = $row['current_level'];
	$_SESSION['mobile'] = $row['mobile'];
	$_SESSION['uname'] = $row['uname'];
	$_SESSION['uemail'] = $row['email'];
	$_SESSION['address'] = $row['address'];
	$_SESSION['id'] = session_id();
	$_SESSION['login_type'] = "user";
	
	echo '<script>window.location.assign("home.php?status=1");</script>';
	
}
else{
	echo '<script>window.location.assign("index.php?status=0");</script>';
}

?>