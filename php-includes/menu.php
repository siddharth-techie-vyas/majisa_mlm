<style>
    .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                <center><img src="http://www.majisaindustries.in/theme/img/logo.png" width="auto" height="30"></center>

                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <?php   $active=mysqli_query($con,"select COUNT(*) AS countm from tree where userid='".$_SESSION['userid']."' "); 
                       $active_row=mysqli_fetch_array($active);
                       $countm=$active_row['countm'];
                       if($countm < 10){
                ?>
                <li class='text-danger blink_me'>Profile is inactive, Add 10 Member(s) to activate your profile !!  </li>
                <?php }?>
                <!-- /.dropdown -->
                <li><em>Welcome, <?php echo $_SESSION['uname'].' [ '.$_SESSION['userid'].' ] ';?></em></li>
            
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-message">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="bank_details.php"><i class="fa fa-inr fa-fw"></i> Bank Details</a>
                        </li>
                        <li><a href="password_change.php"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="pin-request.php"><i class="fa fa-adjust fa-fw"></i> Pin Request</a>
                        </li>
                        <li>
                            <a href="pin.php"><i class="fa fa-adjust fa-fw"></i>View Pin</a>
                        </li>
                        <li>
                            <a href="join.php"><i class="fa fa-adjust fa-fw"></i>Join User</a>
                        </li>
                        <li>
                            <a href="tree.php"><i class="fa fa-adjust fa-hub"></i>Tree</a>
                        </li>
						<li>
                            <a href="payment-received-history.php"><i class="fa fa-adjust fa-hub"></i>Payment Received History</a>
                        </li>
                        <li>
                            <a href="mytransaction.php"><i class="fa fa-adjust fa-hub"></i>My Transaction(s)</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>