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
            <li><em>Welcome, <?php echo $_SESSION['userid'];?></em></li>
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-message">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
            <style>
                .subul li{padding:8px;}
            </style>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li class='sub-menu'><a href='#reg'><i class='fa fa-user fa-fw'></i> Pin & Registration(s)<div class='fa fa-caret-down right'></div></a>
                			<ul class='subul'>
                                <li><a href="bulk_reg.php"><i class="fa fa-user-plus fa-fw"></i> Bulk Registration(s)</a></li>
                                <li><a href="view-pin-request.php"><i class="fa fa-adjust fa-fw"></i> View Pin Request</a></li>
                            </ul>
                        </li>    
                        
                        <li class='sub-menu'><a href='#reports'><i class='fa fa-file-pdf-o fa-fw'></i> Report(s)<div class='fa fa-caret-down right'></div></a>
                			<ul class='subul'>
                		    		<li><a href="active_users.php"><i class="fa fa-user fa-fw"></i> Active Users With Name</a></li>
                		    		<li><a href="inactive_users.php"><i class="fa fa-user-times fa-fw"></i> In-Active Users With Name</a></li>
                		            <li><a href="inactive_users_withoutname.php"><i class="fa fa-users fa-fw"></i> In-Active Users (Bulk / Without Name)</a></li>    		
                			</ul>
                		</li>
                        
                        
                        <li class='sub-menu'><a href='#slab'><i class='fa fa-level-up fa-fw'></i> Slab& Level Managment(s)<div class='fa fa-caret-down right'></div></a>
                			<ul  class='subul'>
                                <li><a href="level.php"><i class="fa fa-arrow-up fa-fw"></i> Level(s)</a></li>
                                <li><a href="slab.php"><i class="fa fa-arrow-up fa-fw"></i>View Slab(s)</a></li>
                                <li><a href="slab_amt.php"><i class="fa fa-inr fa-fw"></i>Allot Slab(s) Amount</a></li>
                                <li><a href="reward.php"><i class="fa fa-inr fa-fw"></i> Reward(s)</a></li>
                            </ul>
                        </li>
                        
                        
                        <li class='sub-menu'><a href='#income'><i class='fa fa-inr fa-fw'></i> Income Managment(s)<div class='fa fa-caret-down right'></div></a>
                			<ul class='subul'>
                                    <li><a href="income.php"><i class="fa fa-rupee fa-fw"></i> Income</a></li>
                                    <li><a href="income-history.php"><i class="fa fa-rupee fa-fw"></i> Income History</a></li>
                            </ul>
                        </li>
                        
                        
                        
                        <li>
                            <a href="tree.php"><i class="fa fa-tree fa-fw"></i> Company Tree</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>