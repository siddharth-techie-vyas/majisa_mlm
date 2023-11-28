<?php
	$db_host = "localhost";
	$db_user = "u275583086_majisa_user";
	$db_pass = "Majisa@#0291";
	$db_name = "u275583086_majisa";
	
	$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if(mysqli_connect_error()){
		echo 'connect to database failed';
	}
	
	 setlocale(LC_MONETARY, 'en_IN');  
	date_default_timezone_set('Asia/Kolkata');
	//-- classes
	include('Class_user.php');
	
	//--- call class function
	if(isset($_GET['function']))
	{
	    $function = $_GET['function'];
	    $function($con,$_GET);
	}
	
?>