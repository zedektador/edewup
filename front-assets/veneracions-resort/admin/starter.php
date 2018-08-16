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
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Montalban Waterpark | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/skins/skin-yellow.min.css">
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
<body class="hold-transition skin-yellow sidebar-mini">
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
					<li>
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
			<!-- Main content -->
			<section class="content container-fluid">
			
			<div class="row">
				<div id="MyDateDisplay" class="dateDisplay"></div>
				<div id="MyClockDisplay" class="clock"></div>
			</div>

			<!-- <div class="form-group">
                <label>Date range:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
				  <input type="text" name="daterange" class="form-control pull-right" value=""/>
                </div>
                
			</div> -->

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
				<br/><h3 class="text-center">Current Reservations</h3>
					<div class="table-responsive">
						<table class="table table-striped" id="current">
							<thead>
								<tr>
									<th>Reservation Code</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Phone number</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Time checked-in</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							include './auth.php';
							$re = mysql_query("SELECT * FROM booking WHERE isActive = 1 AND isReserved=1 AND isCancelled=0 AND isCocoylandia=0");

							if(mysql_num_rows($re) > 0){
								while($row = mysql_fetch_array($re)){
									echo '
										<tr>
											<td>'.$row['reservation_code'].'</td>
											<td>'.$row['first_name'].'</td>
											<td>'.$row['last_name'].'</td>
											<td>'.$row['telephone_no'].'</td>
											<td>'.$row['checkin_date'].'</td>
											<td>'.$row['checkout_date'].'</td>
											<td>'.date_format(date_create($row['checkin_time']), 'h:i:s A').'</td>
											<td>
												
												<a href="checkout.php?booking_id='.$row['booking_id'].'" class="btn btn-danger checkout">Checkout</a>
											</td>
										</tr>
										';
										// <a href="edit-reservation.php?booking_id='.$row['booking_id'].'" class="btn btn-primary">Modify</a>&nbsp;&nbsp;
								}
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<br/>
				
				<div class="col-md-8 col-md-offset-2">
				<h3>List of Rooms</h3>
					<div class="table-responsive">
						<table class="table table-striped" id="roomtable">
                                <thead>
                                    <tr>
                                        <th>Room Name</th>
                                        <th>Image</th>
                                        <th>Total Room</th>
										<th>Available</th>
										<th>Occupied</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										include './auth.php';
										$re = mysql_query("SELECT * from room WHERE isCottage=0 AND isCocoylandia = 0");
										if (mysql_num_rows($re) > 0) {
											while ($row = mysql_fetch_array($re)) {
												echo '
                                                    <tr>
                                                        <td>' . $row['room_name'] . '</td>
                                                        <td><a data-fancybox="gallery" href="../' . $row['imgpath'] . '"><img src="../' . $row['imgpath'] . '" style="height:50px;width:50px;"></a></td>
                                                        <td>' . $row['total_room'] . '</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                ';
											}
										}
									?>
                                </tbody>
                        </table>
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
			<a href="#">Montalban Waterpark and Garden Resort</a>.</strong> All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->

<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker({
		opens: "center"
		// ranges: {
        //    'Today': [moment(), moment()],
        //    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        //    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //    'This Month': [moment().startOf('month'), moment().endOf('month')],
        //    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        // }
	}, function(start,end,label){
		console.log(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD',label))
	});
});

$(document).ready(function() {
    $('#current').DataTable();
} );
</script>
<script>
	function showTime(){

	var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
	var d = date.getDay();
    var a = date.getDate();
	var mo = date.getMonth();
	var y = date.getFullYear();
    var session = "AM";

    if(h == 0){
        h = 12;
    }

    if(h > 12){
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
	var date = dayNames[d] + " " + monthNames[mo] + " " + a + ", " + y;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    document.getElementById("MyDateDisplay").innerText = date;
    document.getElementById("MyDateDisplay").textContent = date;
    setTimeout(showTime, 1000);

	}

	showTime();

	$('.checkout').click (function () {
		return confirm ("Are you sure you want to checkout?") ;
	});
</script>

	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>

</body>

</html>