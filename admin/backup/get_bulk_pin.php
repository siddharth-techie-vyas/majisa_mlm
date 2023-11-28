<?php
//include('php-includes/check-login.php');
require('php-includes/connect.php');

 //print_r($_GET);


if(isset($_GET['count']))
{
 $limit=$_GET['count'];
// if($limit > 30)
// {$limit = '30';}


$user_id=substr($_GET['userid'], 0, 8);


    $query=mysqli_query($con, "select * from pin_list where userid='".$user_id."' AND status='open' ORDER BY id DESC LIMIT $limit "); 
    
    
    while($row=mysqli_fetch_array($query))
    {
        $uname_auto = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        echo "<div class='col-sm-12'><div class='col-sm-3'><label>Pin</label><input type='text' value='".$row['pin']."' name='pin[]' class='form-control' readonly/></div>";
        echo "<div class='col-sm-3'><label>Name</label><input type='text' value='MI$uname_auto' name='uname[]' class='form-control'/></div>";
        echo "<div class='col-sm-3'><label>Mobile Nu.</label><input type='text' value='00000' name='mobilenu[]' class='form-control'/></div></div>";
        
    }
    echo "<hr>";
    
    echo "<div class='col-sm-12'><div class='col-sm-3'><label>Under User ID : </label><input type='text' value='".$user_id."' name='under_userid' class='form-control'/></div>";
    // echo "<div class='col-sm-4'><div class='alert alert-info'>You can add 30 pin in a single time only !!!</div></div>
    echo "<div class='col-sm-3'><input type='button' onclick='generate_member()' value='Save and Generate' name='save' class='btn btn-success'/></div></div>";
}    
    
if(isset($_GET['uname']))
{
    
    
    $pin_array = $_GET['pin'];
    $uname_array = $_GET['uname'];
    $mobilenu_array = $_GET['mobilenu'];
    $under_userid = str_replace(' ', '', $_GET['under_userid']);
    $company_level = get_company_level($con);
   
    
    //-- get user level
    $level_nu = mysqli_query($con, "select current_level from user where pin='$under_userid'");
    $level_nu = mysqli_fetch_array($level_nu);
    $level = $level_nu['current_level'];
	 		
                                for ($i = 0; $i < count($pin_array); $i++) 
								{
								
                                    $pin = mysqli_real_escape_string($con, $pin_array[$i]);
                                    $uname = mysqli_real_escape_string($con, $uname_array[$i]);
									$mobile = mysqli_real_escape_string($con, $mobilenu_array[$i]);
									$password='123456';
									
                                        //Insert into User profile
                                        $newpin_foruser = 'M'.$pin;
                                        $query = mysqli_query($con,"insert into user(`password`,`mobile`,`address`,`under_userid`,`current_level`,`pin`,`uname`) values('$password','$mobile','N/A','$under_userid','1','$newpin_foruser','$uname')");
                                        
                                        if($query){echo $newpin_foruser.' added<br>';}
                                        
                                        
                                        //Update pin status to close
                                        $query1 = mysqli_query($con,"update pin_list set status='close' where pin='$pin'");
                                        if($query1){echo $pin.' pin closed<br>';}
                                        
                                        
                                        //Inset into Income for a new user
                                        $new_user_ledger = mysqli_query($con,"insert into income (`userid`,`day_bal`,`current_bal`,`total_bal`) values('$newpin_foruser','0','0','0')");
                                        
                                        
                                        	$current_user_ledger = mysqli_query($con,"update income SET day_bal=day_bal+20,current_bal=current_bal+20,total_bal=total_bal+20 where userid='".$under_userid."' ");
                                        	
                                        if($query1){echo 'Ledger created<br>';}
                                        
                                        
                                        //-- add new user into tree
                                        $query2 =mysqli_query($con,"insert into tree(userid,pin,level)Values('$under_userid','$pin','$company_level')");
                                        if($query2){echo "Tree Updated<br>";}
                                        
                                        echo $i+1 ." member added<br>";
                                        
                                        
                                        //-- add new member into tree
                                        
                                        $check_level = mysqli_query($con,"select nuofuser from level where levelnu='$level'");
                                        echo "select nuofuser from level where levelnu='$level'";
                                        $check_level = mysqli_fetch_array($check_level);
                                        echo $nuofuser = $check_level['nuofuser'];
                                        
                                        
                                        $count_nuofuser = mysqli_query($con,"select count(id) AS count from tree where userid='$under_userid'");
                                        echo "select count(id) AS count from tree where userid='$under_userid'";
                                        $count_nuofuser = mysqli_fetch_array($count_nuofuser);
                                        echo $actual_under_member= $count_nuofuser['count'];
                                        
                                        if($nuofuser == $actual_under_member)
                                        {
                                            //-- add slab
                                            $colname = 'col'.$level;
                                            $slab = mysqli_query($con,"select * from slab where level = '1'");
                                            //echo  "select $colname AS col from slab where level = '1'";
                                            $slab_row = mysqli_fetch_array($slab);
                                            
                                            echo $amt = $slab_row[$colname];
                                           
                                            $level = $level+1;
                                            //-- increase level of user
                                            $update=mysqli_query($con,"update user SET current_level='$level' where pin='$under_userid' ");
                                            if($update){echo '<br>$level Increament Done';}
                                        
                                            
                                            
                                            $slab_ledger = mysqli_query($con,"update income SET day_bal=day_bal+$amt,current_bal=current_bal+$amt,total_bal=total_bal+$amt where userid='".$under_userid."' ");
                                            if($slab_ledger)
                                            {echo "<br>Slab Amount Received";}
                                            
                                            //-- add transaction amt
                                            $transaction = mysqli_query($con,"insert into transaction(pin,remark,amount)Values('$under_userid','Slab Amount of $level Received','$amt')");
                                            if($transaction)
                                            {echo "<br>Transaction Received";}
                                            
                                            //-- check parent userid and give a comission to him
                                           $parent_level=$level-1;
                                           $colname2 = 'col'.$parent_level;
                                           $amt2 = $slab_row[$colname2];
                                           
                                           
                                           $active_users = get_active_user_array($con);
                                           if(COUNT($active_users) > 0)
                                           {
                                                       $implode_users = implode (", ", $active_users);  
                                                       
                                                       $slab_ledger0 = mysqli_query($con,"update income SET day_bal=day_bal+$amt2,current_bal=current_bal+$amt2,total_bal=total_bal+$amt2 where userid IN ('".$implode_users."') ") ;
                                                        if($slab_ledger0)
                                                        {echo "<br>Slab Amount Received To Parent";}
                                                       
                                                        for($i=0; $i<=COUNT($active_users); $i++)
                                                        {
                                                        $transaction0 = mysqli_query($con,"insert into transaction(pin,remark,amount)Values('$active_users[$i]','Slab Amount of $level Received from $under_userid','$amt2')");
                                                        if($transaction0)
                                                        {echo "<br>Transaction Received To Parent - ".$active_users[$i];}
                                                        }
                                           }
                                           
                                           
                                        }
                                        
                                        echo "<hr>";
									
								}	
}    
    ?>