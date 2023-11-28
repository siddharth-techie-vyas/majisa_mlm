<style>
h5{background:#8F9779; display:block; border-bottom:1px solid #4D5D53; padding:5px 0 5px 0; color:#FFF;}
.userlist li{float: left; list-style:none; margin:3px; padding:5px; border:1px solid; font-size:15px;}
    .userlist li a{
        display: block;
  color: #FFF;
  text-align: center;
  padding: 5px;
  text-decoration: none;
    }
    .userlist li a:hover{color:red; font-style: italic;}
</style>

<?php 
include('php-includes/connect.php');
$start='0';
$limit='10';
$level0 = mysqli_query($con,"select * from level where levelnu > 1");
while($row=mysqli_fetch_array($level0)){
?>    
<div class="col-lg-12 text-center">
    <h5>Level <?php echo $row['levelnu']-1;?></h5>
    <ul class='userlist'>
    <?php 
        // --- check user availble in level or not  and set automatically in list
        $levelcount=mysqli_query($con,"select * from tree where userid='".$_GET['pin']."' LIMIT $start, $limit");
            
           // echo "select * from tree where userid='".$_SESSION['userid']."' LIMIT $start, $limit";
        
        if(mysqli_num_rows($levelcount)<1)
        {echo "No Member Found"; exit(); }
        while($row0=mysqli_fetch_array($levelcount)){ 
            $count_user=get_user_count_under($con,'M'.$row0['pin']);
            if($count_user >= 10){$bg='btn btn-success';}
            else{$bg='btn btn-danger';}
            echo "<li class='$bg'><a href='tree-total.php?pin=".$row0['pin']."'><i class='fa fa-user fa-1x'> M".$row0['pin']."</i></a></li>";
        }
        
        $start=$row['nuofuser'];
        $limit=$row['nuofuser']*10;
    ?>
    </ul>
</div>
<?php }?>