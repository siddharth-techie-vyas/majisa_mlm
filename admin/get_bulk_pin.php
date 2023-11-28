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
    
    
   
    
	 		
                                for ($i = 0; $i < count($pin_array); $i++) 
								{
								
                                    $pin = mysqli_real_escape_string($con, $pin_array[$i]);
                                    $uname = mysqli_real_escape_string($con, $uname_array[$i]);
									$mobile = mysqli_real_escape_string($con, $mobilenu_array[$i]);
									$password='123456';
									
									
								         // 1. first check company total user level 
                                            $company_level = get_company_level($con);
                                            
								        
								        //========2. add members and other 
									
                                        //Insert into User profile
                                        $newpin_foruser = 'M'.$pin;
                                        $query = mysqli_query($con,"insert into user(`password`,`mobile`,`address`,`under_userid`,`current_level`,`pin`,`uname`) values('$password','$mobile','N/A','$under_userid','1','$newpin_foruser','$uname')");
                                        
                                        if($query){echo $newpin_foruser.' added<br>';}
                                        
                                        
                                        //Update pin status to close
                                        $query1 = mysqli_query($con,"update pin_list set status='close' where pin='$pin'");
                                        if($query1){echo $pin.' pin closed<br>';}
                                        
                                        
                                        //Inset into Income for a new user
                                        $new_user_ledger = mysqli_query($con,"insert into income (`userid`,`day_bal`,`current_bal`,`total_bal`) values('$newpin_foruser','0','0','0')");
                                        if($query1){echo 'Ledger created<br>';}
                                        
                                        
                                        //20 rs for a parent as a reward
                                        $current_user_ledger = mysqli_query($con,"update income SET day_bal=day_bal+20,current_bal=current_bal+20,total_bal=total_bal+20 where userid='".$under_userid."' ");
                                        	
                                        
                                        //-- add new user into tree
                                        $query2 =mysqli_query($con,"insert into tree(userid,pin,level)Values('$under_userid','$pin','$company_level')");
                                        if($query2){echo "Tree Updated<br>";}
                                        echo $i+1 ." member added<br>";
                                        
                                        
                                       //-- 3. update level after user insert 
                                        $total_user_in_company_level = get_user_in_level_from_tree($con,$company_level);
                                        $user_in_level = get_total_user_in_level($con,$company_level);
                                            
                                            
                                            if($total_user_in_company_level == $user_in_level)
                                            {
                                               //-- increas company level
                                               $in_comp_level = mysqli_query($con,"update company SET level=level+1 where id='1' ");
                                               echo "<br>Level Updated";
                                               
                                               //-- increase active user level
                                               $active_users = get_active_user_array($con);
                                               
                                                  if(COUNT($active_users)>0)
                                                  {
                                                      $active_users0 = implode(" ',' ",$active_users);
                                                      echo "update user SET current_level=current_level+1 where pin IN ('$active_users0') ";
                                                      $in_active_user_level = mysqli_query($con,"update user SET current_level=current_level+1 where pin IN ('$active_users0') ");
                                                  }   
                                               
    								        }
    								       
								           
								        
								        //=== recheck the company level and set if has diffrence
								         /*$company_level_updated = get_company_level($con);
                                         if($company_level != $company_level_updated)
                                         {
                                             //== update newly added user
                                             mysqli_query($con,"update tree SET level='$company_level_updated' where pin='$pin' ");
                                             echo "<br>Level Updated";
                                         }*/
                                        
								        echo "<hr>";
                                } 
}
    ?>