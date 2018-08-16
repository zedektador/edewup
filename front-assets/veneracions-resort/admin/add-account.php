<?php
session_start();

include './auth.php';
$re = mysql_query("SELECT * from admin WHERE username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "'");
echo mysql_error();
if (mysql_num_rows($re) > 0) {

} else {
    session_destroy();
    header("location: index.html");
}

if(isset($_POST['signUp'])) {
	$username = trim($_POST['username']);
	$emailAddress = trim($_POST['emailAddress']);
	$tpassword = trim($_POST['password']);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contactNumber = $_POST['contactNumber'];
    $emailAddress = $_POST['emailAddress'];
    $cpassword = $_POST['cpassword'];
	$isAdmin = (int)$_POST['isAdmin'];
	$username = strip_tags($username);
	$emailAddress = strip_tags($emailAddress);
	$upassword = strip_tags($tpassword);
	
	// password encrypt using SHA256();
	$password = hash('sha256', $upassword);
    // check emailAddress exist or not
 
	$query = "SELECT emailAddress FROM admin WHERE emailAddress='$emailAddress'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if emailAddress not found then proceed
	if ($count==0) {
		$query = "INSERT INTO admin(username, emailAddress, password, firstName, lastName, contactNumber, isAdmin) VALUES('$username','$emailAddress','$password','$firstName','$lastName',$contactNumber,$isAdmin)";
		$res = mysql_query($query);
		
		if ($res) {
			$errTyp = "success";
			$errMSG = "Successfully registered, you may login now";
		} else {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later...";	
		}	
			
	} else {
		$errTyp = "warning";
		$errMSG = "Email address already in use.";
	}
	
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cocoylandia Family Resort | Accounts</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="dist/css/devStyle.css">

	<!-- Include Required Prerequisites -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"/>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.js"></script>

	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="starter.php" class="logo">
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
								<span class="hidden-xs"><?php echo $_SESSION['username'] ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="dist/img/blank.jpg" class="img-circle" alt="User Image">
									<p>
										<?php echo $_SESSION['username'] ?>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="profile.php" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">

				<!-- Sidebar user panel (optional) -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="dist/img/blank.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?php echo $_SESSION['username'] ?></p>
						<!-- Status -->
						<a href="#">
							<i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">HEADER</li>
					<!-- Optionally, you can add icons to the links -->
					<li class="active">
						<a href="starter.php">
							<i class="fa fa-link"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-bed"></i>
							<span>Accommodations</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="rooms.php">Rooms</a>
							</li>
							<li>
								<a href="cottages.php">Cottages</a>
							</li>
							<li>
								<a href="amenities.php">Amenities</a>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-bars"></i>
							<span>Reservation</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="pending-reservation.php">Pending</a>
							</li>
							<li>
								<a href="checkedout-reservation.php">Checked-out</a>
							</li>
							<li>
								<a href="modified-reservation.php">Modified</a>
							</li>
							<li>
								<a href="cancelled-reservation.php">Cancelled</a>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-bar-chart"></i>
							<span>Reports</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="sales-report.php">Sales</a>
							</li>
							<li>
								<a href="request-report.php">Request</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="add-walkin.php">
							<i class="fa fa-link"></i>
							<span>Walk-in Module</span>
						</a>
					</li>
					<li class="active">
						<a href="useraccounts.php">
							<i class="fa fa-link"></i>
							<span>User Account Module</span>
						</a>
					</li>
					<li>
					<li>
					<a href="../../cocoylandia/admin/starter.php">
							<i class="fa fa-link"></i>
							<span>Cocoylandia Admin</span>
						</a>
					</li>
				</ul>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Add Account
				</h1>
			</section>

			<!-- Main content -->
			<section class="content container-fluid">

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="useraccounts.php" class="btn btn-primary">Back</a>
                        </div>
                        <div class="panel-body">
                            <form method="post" autocomplete="off">
                            <?php
                        if ( isset($errMSG) ) {
                            
                            ?>
                            <div class="form-group">
                            <div class="alert alert-dismissable alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info"></i> <?php echo $errMSG; ?>
                            </div>
                            </div>
                            <?php
                        }
                        ?>
								<div class="form-group">
                                <label for="isAdmin">Priviledge</label>
								<select class="form-control" name="isAdmin" id="isAdmin" required>
									<option value="1">Admin</option>
									<option value="0" selected>Receptionist</option>									
								</select>
                                </div>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactNumber">Contact Number</label>
                                    <input type="number" class="form-control" name="contactNumber" id="contactNumber" placeholder="Contact number" required>
                                </div>
                                <div class="form-group">
                                    <label for="emailAddress">Email Address</label>
                                    <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Email address" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" onkeyup="check();" placeholder="Password" required>
                                </div>
								<div class="form-group">
                                    <label for="cpassword">Confirm password</label>
                                    <input type="password" class="form-control" name="cpassword" id="cpassword" onkeyup="check();" placeholder="Confirm password" required>
                                    <span id="message"></span>
                                </div>
                                <button type="submit" id="submit" class="btn btn-default" name="signUp">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<!-- Default to the left -->
			<strong>Copyright &copy; 2017
				<a href="#">Cocoylandia Family Resort</a>.</strong> All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->
    <script>
    var check = function() {
        if (document.getElementById('password').value!=""){
            if (document.getElementById('password').value == document.getElementById('cpassword').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Passwords are matched!';
            document.getElementById('submit').disabled = false;
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Passwords are not matched!';
            document.getElementById('submit').disabled = true;
        }
        }
        
    }
    </script>
	<!-- REQUIRED JS SCRIPTS -->
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>

</body>

</html>