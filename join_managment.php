<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];

?>
<?php
//User cliced on join
if(isset($_GET['join_user'])){
	$side='';
	$pin = mysqli_real_escape_string($con,$_GET['pin']);
	$uname = mysqli_real_escape_string($con,$_GET['name']);
	$email = mysqli_real_escape_string($con,$_GET['email']);
	$mobile = mysqli_real_escape_string($con,$_GET['mobile']);
	$address = mysqli_real_escape_string($con,$_GET['address']);
// 	$account = mysqli_real_escape_string($con,$_GET['account']);
	$under_userid = mysqli_real_escape_string($con,$_GET['under_userid']);
// 	$side = mysqli_real_escape_string($con,$_GET['side']);
    //$level = mysqli_real_escape_string($con,$_GET['level']);

	$password = "123456";
	
	$flag = 0;
	
		// 1. ====== check user id
		$query =mysqli_query($con,"select * from user where email='$email' OR pin ='$email' ");
    	if(mysqli_num_rows($query)>0){
    		//-- if pin is already used then return
		    echo '<script>window.location.href="join.php?status=3";</script>';
    	}
    	
    	// 2. ===== close pin status
		$query =mysqli_query($con,"select * from pin_list where pin='$pin' and userid='$userid' and status='open'");
		if(mysqli_num_rows($query)<1)
		{
		    //-- if pin is already used then return
		    echo '<script>window.location.href="join.php?status=2";</script>';
		}    
		
		// 3. ===== process tree and commision
    	
    	//--- check user's current level'
    	$level_value = $_SESSION['level'];
    	
    	
    	
    	
    	//-- add new member into tree
    	$query =mysqli_query($con,"insert into tree(userid,pin,level)Values('$under_userid','$pin','".$_SESSION['level']."')");
    	
    	//--- check user nu of user in level count
    	$query2 =mysqli_query($con,"select COUNT(*) AS countuser from tree where userid='$under_userid' AND level='$level_value'");
    	$result2 = mysqli_fetch_array($query2);
    	$current_nu_level = $result2['countuser'];
    	
    	//-- check count where level member require
    	$query1 =mysqli_query($con,"select * from level where levelnu='$level_value'");
    	$result1 = mysqli_fetch_array($query1);
    	$nuofuser = $result1['nuofuser'];
    	
    
    	//-- compare both level's nu of user, update if completeed
    	if($current_nu_level == $nuofuser)
    	{
    	  $cur_level=$level_value+1;  
    	  //-- change session 
    	  $_SESSION['level']=$cur_level;
    	
    	  //-- update logged in user's level
    	  $query =mysqli_query($con,"update user SET current_level='$cur_level' where pin='$under_userid'");
    	
    	
    	    //-- update level of recently added user
        	$update_cur =mysqli_query($con,"update tree SET level='".$cur_level."' where pin='$pin'");
    	    	
    	
    	  
    	  //check comission if level completed(single user)
    		$slab=mysqli_query($con,"select * from slab where level='$cur_level'");
    		$commision=$slab['col'.$cur_level];
    		
    	  //save transaction and income
    	 	$transaction = mysqli_query($con,"insert into transaction(pin,remark,amount)Values('$under_userid','Reward Amount Received For A $cur_level Level Up','$commision')");
    	 
    	  //get income	
    	 	$ci = mysqli_query($con,"select * from income where pin = '$under_userid'");
    	 	$ci=mysqli_fetch_array($ci);
    	 	$day=$ci['day_bal']+$commission;
    	 	$current=$ci['current_bal']+$commission;
    	 	$total=$ci['total_bal']+$commission;
    	 	
    	 	$pin_own=ltrim( $_SESSION['userid'] , 'M' );
    		$income = mysqli_query($con,"update income SET day_bal='$day',current_bal='$current',total_bal='$total' where userid='$pin_own' ");
    		//echo "update income SET day_bal='$day',current_bal='$current',total_bal='$total' where userid='$pin_own' ";
    		//exit();
    	}

        
    	
	   
	
    	//== 4. final user creation
    		
    		//Insert into User profile
    		$newpin_foruser = 'M'.$pin;
    		$query = mysqli_query($con,"insert into user(`email`,`password`,`mobile`,`address`,`under_userid`,`current_level`,`pin`,`uname`) values('$email','$password','$mobile','$address','$under_userid','1','$newpin_foruser','$uname')");
    		
    		
    		
    		//Update pin status to close
    		$query = mysqli_query($con,"update pin_list set status='close' where pin='$pin'");
    		
    		
    		//-- add details in transaction with initial 20 RS
    	//	$transaction = mysqli_query($con,"insert into transaction(pin,remark,amount)Values('$newpin_foruser','Reward Amount Received For A New Joining','20')");
    		
    		//Inset into Income for a new user
    		$new_user_ledger = mysqli_query($con,"insert into income (`userid`,`day_bal`,`current_bal`,`total_bal`) values('$newpin_foruser','0','0','0')");
    		
    		$current_user_ledger = mysqli_query($con,"update income SET day_bal=day_bal+20,current_bal=current_bal+20,total_bal=total_bal+20 where userid='".$_SESSION['userid']."' ");
    	//	echo "update income SET day_bal='day_bal+20',current_bal='current_bal+20',total_bal='total_bal+20' where userid='".$_SESSION['userid']."' ";
    	//	exit();
    		
    		
    			echo mysqli_error($con);
    		
    		echo '<script>window.location.href="join.php?status=1";</script>';
    	
	
}
?>