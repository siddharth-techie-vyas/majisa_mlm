<?php

require('php-includes/connect.php');

//$email = mysqli_real_escape_string($con,$_POST['email']);
$mobile = mysqli_real_escape_string($con,$_POST['mobile']);
$address = mysqli_real_escape_string($con,$_POST['address']);
$name = mysqli_real_escape_string($con,$_POST['name']);

//$query = mysqli_query($con,"select * from user where email='$email'  and password='$password'");

//get email from pin
$query0 = mysqli_query($con,"select * from user where mobile='$mobile' ");
//$query = mysqli_query($con,"select * from user where email='$email' ");

if(mysqli_num_rows($query0)>0)
{
	echo "<script>window.location.href='register.php?status=0';</script>";
}
// elseif(mysqli_num_rows($query)>0)
// {
// 	echo "<script>window.location.href='register.php?status=0';</script>";
// }
elseif(strlen($mobile)>10 || strlen($mobile)<10)
{
	echo "<script>window.location.href='register.php?status=3';</script>";
}
else
{
$rand = substr(str_shuffle("123456789"), 0, 8);
$pin = 'M'.substr(str_shuffle("123456789"), 0, 7);
// increase company level 
        
        
        
//$query = mysqli_query($con,"insert into user(email,uname,mobile,address,password,pin,current_level)Values('$email','$name','$mobile','$address','$rand','$pin','1')");
$query = mysqli_query($con,"insert into user(uname,mobile,address,password,pin,current_level)Values('$name','$mobile','$address','$rand','$pin','1')");
  
    if($query)
    {       
        //Create Ledger 
    		$query = mysqli_query($con,"insert into income (`userid`,`day_bal`,`current_bal`,`total_bal`) values('$pin','0','0','0')");
            //save into tree
            $company_level = get_company_level($con);        
           // $query2 =mysqli_query($con,"insert into tree(userid,pin,level)Values('$pin','$rand','$company_level')");
            
            //update company level in tree
              $user_intree = get_user_in_level_from_tree($con,$company_level);
                 $user_inlevel = get_total_user_in_level($con,$company_level);
                 
            if($user_intree==$user_inlevel)
            {
                company_level_check($con);
                $query3 =mysqli_query($con,"update tree SET level='$company_level' where pin='$pin' ");    
            }
        
        
        
        
            //-- send sms by api 
            
$api_key = '36512609A01D0B';
$contacts = $mobile;
$from = 'MAJSAI';
$sms_text = urlencode("Dear $name, Thank you for a registration in MAJISA INDUSTRIES. Your login details are - username- $pin & pass- $rand Majisa Industries Webitute");
$pe_id = '1201169570467902220';
$template_id = '1207169924761773526';
$campaign = '15648';
$api_url = "https://sms.k7marketinghub.com/app/smsapi/index.php?key=".$api_key."&campaign=".$campaign."&routeid=30&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id."&pe_id=".$pe_id;

//Submit to server

echo $response = file_get_contents($api_url);

            
            
            
                                       
        
    	echo '<script>window.location.assign("register.php?status=1");</script>';
    	
    }
    else{
    	echo '<script>window.location.assign("register.php?status=2");</script>';
        }
}

?>