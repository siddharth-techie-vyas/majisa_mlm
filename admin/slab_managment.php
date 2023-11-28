<?php
include('php-includes/check-login.php');
require('php-includes/connect.php');

if(isset($_POST['save_level']))
{
    //print_r($_POST);
    $slab_array = $_POST['slabnu'];
    
    
    //-- max nu of slab from meta 
	 		            $level=mysqli_query($con, "select * from meta_data where metaname='slab'");
                        $level=mysqli_fetch_array($level);
                        $nuofslab=$level['value1'];
                        
                        
                        
                                for ($i = 0; $i < count($slab_array); $i++) 
								{
								
                                    $level = mysqli_real_escape_string($con, $slab_array[$i]);
    								
									
                                    //=== check availability
                                    
					 			    $select = mysqli_query($con,"select * from level where level = '$level'  ");
                                    if(mysqli_num_rows($select)>0)
                                    {
                                       $amt_array = $_POST[$i.'amount'];
                                       for ($j = 0; $j < count($nuofslab); $j++) 
								        {
								        $col = mysqli_real_escape_string($con, $amt_array[$j]);    
                                        $update=mysqli_query($con,"update slab SET  col$j='$col' where level='$level' ");
								        }
                                        if($update)
                                        {echo "updated successfully";}
                                    } 
                //                     else
                //                     {
                                      
                //                         $amt_array = $_POST[$i.'amount'];
                                        
                //                       for ($j = 0; $j < count($nuofslab); $j++) 
								        // {
								        // $col = mysqli_real_escape_string($con, $amt_array[$j]);    
                //                         $update=mysqli_query($con,"insert into slab col$j='$col' where level='$level' ");
								        // }
                //                         if($update)
                //                         {echo "updated successfully";}
                                        
                //                     }
                                   echo "<script>window.location.href='slab.php?status=1';</script>";
						        }
}
?>