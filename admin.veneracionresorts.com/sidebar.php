<?php
include("weblock.php");
include("expire.php");
include("delPaid.php");
include("delWait.php");

?>	

<header class="main-header">

			<!-- Logo -->
			<a href="index.php" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">
					<b>ADM</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">
					<b>ADMIN</b></span>
			</a>

			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								<img src="dist/img/blank.jpg" class="user-image" alt="User Image">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs"><?php //echo $_SESSION['username'] ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="dist/img/blank.jpg" class="img-circle" alt="User Image">
									<p>
										<?php echo $_SESSION['user'] ?>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="profile.php" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
<br><br>
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="dist/img/blank.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?php echo $_SESSION['user'] ?></p>
						<!-- Status -->
						<a href="#">
							<i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATIONS</li>
					<!-- Optionally, you can add icons to the links -->
					<li>
						<a href="index.php">
							<i class="glyphicon glyphicon-list-alt"></i>
							<span>Dashboard</span>
						</a>
					</li>
					
				
					<li class="treeview">
						<a href="#">
							<i class="glyphicon glyphicon-tasks"></i>
							<span>Transaction</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="walk_checkin.php">Walk in Check-in</a>
							</li>
							<li>
								<a href="reservation.php">Walk-in Reservation</a>
							</li>
							<li>
								<a href="reservation_list.php">Reservation List</a>
							</li>
							
							
						</ul>
					</li>
					
					<li>
						<a href="directory.php">
							<i class="glyphicon glyphicon-book"></i>
							<span>Guests' Directory</span>
						</a>
					</li>
					
					<li class="treeview">
						<a href="#">
							<i class="glyphicon glyphicon-bed"></i>
							<span>Room Management</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="add_room.php">Add Room Type</a>
							</li>
							<li>
								<a href="room_types.php">List of Room Types</a>
							</li>
							<li>
								<a href="maintenance.php">Room Maintenance</a>
							</li>
							
							
						</ul>
					</li>
					
					<li class="treeview">
						<a href="#">
							<i class="glyphicon glyphicon-blackboard"></i>
							<span>Amenities/Rentals</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="amenities.php">Amenities</a>
							</li>
							<li>
								<a href="inventory.php">Rentals</a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="bankpayments.php">
							<i class="glyphicon glyphicon-folder-open"></i>
							<span>Proof of Payments</span>
						</a>
					</li>
					
					<li>
						<a href="messages.php">
							<i class="glyphicon glyphicon-comment"></i>
							<span>Messages</span>
						</a>
					</li>
					
					<li>
						<a href="reports.php">
							<i class="glyphicon glyphicon-paperclip"></i>
							<span>Reports</span>
						</a>
					</li>
					
					<li class="treeview">
						<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							<span>Accounts</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="staffs.php">Add Staff Accounts</a>
							</li>
							<li>
								<a href="staff_list.php">Staff Accounts</a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="genset.php">
							<i class="glyphicon glyphicon-cog"></i>
							<span>General Settings</span>
						</a>
					</li>
					
					
					
					
				</ul>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>
		
		