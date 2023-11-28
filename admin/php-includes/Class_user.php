<?php



function get_user($con,$pin)
{
   // echo "select * from user where pin='$pin' ";
    
    $query=mysqli_query($con,"select * from user where pin='$pin' ");
    $row=mysqli_fetch_array($query);
    return $row;
}

function get_user_count_under($con,$pin)
{
   // echo "select COUNT('pin') AS count from tr where under_userid='$pin' ";
    $query=mysqli_query($con,"select COUNT('pin') AS count from tree where userid='$pin' ");
    $row=mysqli_fetch_array($query);
    return $row['count'];
}

function get_total_user($con)
{
    $query=mysqli_query($con,"SELECT COUNT(id) as count FROM `user`");
    $row=mysqli_fetch_array($query);
    return $row['count'];
}

function get_active_user($con)
{
    $query=mysqli_query($con,"SELECT COUNT(id),userid FROM `tree` GROUP BY userid HAVING COUNT(id)>=10");
    $row=mysqli_fetch_array($query);
    return mysqli_num_rows($query);
}

function get_active_user_all_data($con)
{
    $query=mysqli_query($con,"SELECT COUNT(id),userid FROM `tree` GROUP BY userid HAVING COUNT(id)>=10 ");
    $row=mysqli_fetch_array($query);
    return $row;
}

function get_inactive_user($con)
{
    $query=mysqli_query($con,"SELECT * FROM user u INNER JOIN tree t where u.pin=t.userid HAVING COUNT(t.id) < 10");
    $row=mysqli_fetch_array($query);
    return mysqli_num_rows($query);
}

function get_active_user_array($con)
{
    $users = array();
    $query=mysqli_query($con,"SELECT * FROM `tree` GROUP BY userid HAVING COUNT(id)>=10");
    if(mysqli_num_rows($query) < 1)
    {return false;}
    else
    {
        while($row=mysqli_fetch_array($query))
        {
            array_push($users,$row['userid']);
        }
        return $users;
    }    
}


function company_level_check($con)
{
    $current_level = get_company_level($con);
     $user_intree = get_user_in_level_from_tree($con,$current_level);
     $user_inlevel = get_total_user_in_level($con,$current_level);
    if($user_intree == $user_inlevel)
    {
        $query=mysqli_query($con,"update company SET level=level+1 where id='1' ");
    }
    
    
}



function get_company_level($con)
{
    $query=mysqli_query($con,"SELECT * FROM `company`");
    $row=mysqli_fetch_array($query);
    return $row['level'];
}

function get_user_in_level_from_tree($con,$company_level)
{
   // echo "SELECT COUNT(id) AS count FROM `tree` where level='$company_level' ";
    $query=mysqli_query($con,"SELECT COUNT(id) AS count FROM `tree` where level='$company_level' ");
    $row=mysqli_fetch_array($query);
    return $row['count'];
}

function get_total_user_in_level($con,$company_level)
{
   // echo "SELECT nuofuser AS count FROM `level` where levelnu='$company_level' ";
    $query=mysqli_query($con,"SELECT nuofuser AS count FROM `level` where levelnu='$company_level' ");
    $row=mysqli_fetch_array($query);
    return $row['count'];
}

//-- user tree details
function get_user_tree_level($con,$userid)
{
   // echo "SELECT level FROM `tree` where pin='$userid' ";
    $query=mysqli_query($con,"SELECT level FROM `tree` where pin='$userid' ");
    $row=mysqli_fetch_array($query);
    return $row['level']; 
}

function get_user_active_user($con,$userid)
{
    $query=mysqli_query($con,"SELECT COUNT(id),userid FROM `tree` GROUP BY userid HAVING COUNT(id) < 10");
    $row=mysqli_fetch_array($query);
    return mysqli_num_rows($query); 
}

function get_total_slab_income($con)
{
    $query=mysqli_query($con,"SELECT SUM(amount) AS amount FROM `transaction`");
    $row=mysqli_fetch_array($query);
    return $row['amount']; 
}

function delete_user($con,$get)
{
 
    $query=mysqli_query($con,"delete from user where pin='".$get['id']."' ");
    if($query)
    {echo "User delete successfully !!!"; $query=mysqli_query($con,"delete from tree where userid='".$get['id']."' ");}
    else
    {echo "Something went wrong";}
}

function get_slab_amt($con,$get)
{
   $pin=$get['pin'];
   $user=get_user($con,$pin);
   
   //-- current level
    //$current_level = $user['current_level'];
    
   
    
    $company0 = mysqli_query($con,"select * from company where id='1'");
    $company=mysqli_fetch_array($company0);
    $comp_level=$company['level'];
    
     //-- tree level
    $tpin=str_replace("M",'',$pin);
    $current_level = get_user_tree_level($con,$tpin);
    $current_level =  $comp_level-$current_level;
    
    //-- slab data
    // $slab = mysqli_query($con,"select * from slab where level = '1'");
    // $slab_row = mysqli_fetch_array($slab);
    //-- current level amt
   // $amt_of_current_level = $slab_row['col'.$current_level];
    
    //-- skip $i first if userid = 1
            if($user['id']=='1')
            {$current_level=$current_level-1;}
        
    
    //-- check previous slab amt
    for($i=$current_level;$i>=1;$i--)
    {
       
        $k=$i-1;
        
        $slab = mysqli_query($con,"select * from slab where level = '1'");
        $slab_row = mysqli_fetch_array($slab);
        $amt=$slab_row['col'.$i];
            
            //-- check level
            $slab_amt=mysqli_query($con,"select * from slab_amt where pin='".$user['pin']."' AND level='".$i."' ORDER BY id DESC ");
            if(mysqli_num_rows($slab_amt)>0)
            {
                
                $slab_row=mysqli_fetch_array($slab_amt);
                echo "Slab Amount Sent of ".$slab_row['amt']." on ".$slab_row['dateon'];
               // echo "<script>$('#slab_form$get[count]').hide();</script>";
            }
            else
            {
                //-- calculate the amt and print 
                echo $i.'->'.$amt.'<br>';
                
            }
            
        // break when loop lost    
        if($i==1){break;}
    }
    
    
    //-- check amt receive to client or not in slab_amt table
    
    
   
   
}

function save_slab_amt($con,$get)
{
    $pin=$get['pin'];
    $amt=$get['amt'];
    $level=$get['level'];
    //--transaction
    $transaction0 = mysqli_query($con,"insert into transaction(pin,remark,amount)Values('".$pin."','Slab Amount of $level Received from Company','".$amt."')");
    if($transaction0)
    {echo "<br>Transaction Received To - ".$pin;}
    
    //-- send income
    $slab_ledger0 = mysqli_query($con,"update income SET day_bal=day_bal+$amt,current_bal=current_bal+$amt,total_bal=total_bal+$amt where userid = '".$pin."' ");
    if($slab_ledger0)
    {echo "<br>Slab Amount Received To ".$pin;}
    
    //-- save slab amt details
    $slab_details =mysqli_query($con,"insert into slab_amt(pin,amt,level)Values('$pin','$amt','$level')");
}

function get_slab_amt_user($con,$pin,$level)
{
  $slab_amt=mysqli_query($con,"select * from slab_amt where pin='".$pin."' AND level='".$level."'  ");
    if(mysqli_num_rows($slab_amt)>0)
    {return true;}
    else
    {return false;}
}

function get_user_in_level($con,$level)
{
    $slab = mysqli_query($con,"select COUNT(id) as count from user where current_level = '$level'");
    $slab_row = mysqli_fetch_array($slab);
   return $slab_row['count'];
}

function update_level_as_per_count($con,$previous_level,$pin)
{
 //-- get count from tree where users are in $previous level
 $count=mysqli_query($con, "select COUNT('id') as id from tree where level='$previous_level'");
 $count_row = mysqli_fetch_array($count);
 $total_prev_count =  $count_row['id'];
}
?>