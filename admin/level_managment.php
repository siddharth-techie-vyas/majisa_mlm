<?php
include('php-includes/check-login.php');
require('php-includes/connect.php');

if(isset($_POST['save_level']))
{
    //print_r($_POST);
    $nuofuser_array = $_POST['nuofuser'];
    $amt_array = $_POST['amount'];
    $levelnu_array = $_POST['levelnu'];
	 		
                                for ($i = 0; $i < count($nuofuser_array); $i++) 
								{
								
                                    $nuofuser = mysqli_real_escape_string($con, $nuofuser_array[$i]);
                                    $amt = mysqli_real_escape_string($con, $amt_array[$i]);
									$level = mysqli_real_escape_string($con, $levelnu_array[$i]);
									
                                    //=== check availability
                                    //echo "select * from level where levelnu = '$level' AND nuofuser !='0' ";
					 			    $select = mysqli_query($con,"select * from level where levelnu = '$level' AND nuofuser !='0' ");
                                    if(mysqli_num_rows($select)>0)
                                    {
                                       // echo "update level SET nuofuser='$nuofuser' , amt='$amt' where levelnu = '$level'";
                                        $update=mysqli_query($con,"update level SET nuofuser='$nuofuser' , amt='$amt' where levelnu = '$level'");
                                        if($update)
                                        {echo "updated successfully";}
                                    } 
                                    else
                                    {
                                      //  echo "insert into level SET(levelnu,nuofuser,amt)Values('$level','$nuofuser','$amt')";
                                        $save=mysqli_query($con,"insert into level(levelnu,nuofuser,amt)Values('$level','$nuofuser','$amt')");
                                        if($save)
                                        {echo "saved successfully";}
                                    }
                                   echo "<script>window.location.href='level.php?status=1';</script>";
						        }
}
?>