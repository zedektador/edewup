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
	<title>Montalban Waterpark | Sales Report</title>
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
    
    <!-- fancyBox files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
     $( function() {
     $( "#tabs" ).tabs();
     } );
    </script>
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
					<li>
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
					<li class="treeview active">
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
			<section class="content-header">
				<h1>
					Reports > Bills
				</h1>
			</section>

			<!-- Main content -->
			<section class="content container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                
                            </div>
                            <div class="panel-body">
                                <div id="tabs">
                                        <ul>
                                            <li><a href="#all">All</a></li>
                                            <li><a href="#annual">Annual</a></li>
                                            <li><a href="#monthly">Monthly</a></li>
                                            <li><a href="#weekly">Weekly</a></li>
                                            <li><a href="#daily">Daily</a></li>
                                            <li><a href="#custom">Custom</a></li>         
                                        </ul>
                                        <div id="all">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="alltable">
                                                    <thead>
                                                        <tr>
                                                            <th>Reservation Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Total bill</th>
                                                            <th>Amount Paid</th>
                                                            <th>Payment Status</th>
                                                            <th>Bank Slip</th>
                                                            <th>Booking Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    include './auth.php';
                                                    $re = mysql_query("SELECT * FROM booking WHERE isCocoylandia=0");

                                                    if(mysql_num_rows($re) > 0){
                                                        while($row = mysql_fetch_array($re)){
                                                            if($row['bank_slip']!=null)
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td><a data-fancybox="gallery" href="../' . $row['bank_slip'] . '"><img src="../' . $row['bank_slip'] . '" style="height:50px;width:50px;"></a></td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                            else
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td>None</td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                $row = mysql_fetch_array(mysql_query("SELECT SUM(amount_paid) FROM booking WHERE isCocoylandia=0"));
                                                echo '<h5>TOTAL: ₱ <b>'.number_format(array_sum($row)).'</b></h5>' 
                                                ?>
                                            </div>
                                        </div>
                                        <div id="annual">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="annualtable">
                                                    <thead>
                                                        <tr>
                                                            <th>Reservation Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Total bill</th>
                                                            <th>Amount Paid</th>
                                                            <th>Payment Status</th>
                                                            <th>Bank Slip</th>
                                                            <th>Booking Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    include './auth.php';
                                                    $re = mysql_query("SELECT * FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 YEAR)) and (NOW()) AND isCocoylandia=0");

                                                    if(mysql_num_rows($re) > 0){
                                                        while($row = mysql_fetch_array($re)){
                                                            if($row['bank_slip']!=null)
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td><a data-fancybox="gallery" href="../' . $row['bank_slip'] . '"><img src="../' . $row['bank_slip'] . '" style="height:50px;width:50px;"></a></td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                            else
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td>None</td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                $row = mysql_fetch_array(mysql_query("SELECT SUM(amount_paid) FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 YEAR)) and (NOW()) AND isCocoylandia=0"));
                                                echo '<h5>TOTAL: ₱ <b>'.number_format(array_sum($row)).'</b></h5>' 
                                                ?>
                                            </div>
                                        </div>
                                        <div id="monthly">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="monthlytable">
                                                    <thead>
                                                        <tr>
                                                            <th>Reservation Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Total bill</th>
                                                            <th>Amount Paid</th>
                                                            <th>Payment Status</th>
                                                            <th>Bank Slip</th>
                                                            <th>Booking Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    include './auth.php';
                                                    $re = mysql_query("SELECT * FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 MONTH)) and (NOW()) AND isCocoylandia=0");

                                                    if(mysql_num_rows($re) > 0){
                                                        while($row = mysql_fetch_array($re)){
                                                            if($row['bank_slip']!=null)
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td><a data-fancybox="gallery" href="../' . $row['bank_slip'] . '"><img src="../' . $row['bank_slip'] . '" style="height:50px;width:50px;"></a></td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                            else
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td>None</td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                $row = mysql_fetch_array(mysql_query("SELECT SUM(amount_paid) FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 MONTH)) and (NOW()) AND isCocoylandia=0"));
                                                echo '<h5>TOTAL: ₱ <b>'.number_format(array_sum($row)).'</b></h5>' 
                                                ?>
                                            </div>
                                        </div>
                                        <div id="weekly">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="weeklytable">
                                                    <thead>
                                                        <tr>
                                                            <th>Reservation Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Total bill</th>
                                                            <th>Amount Paid</th>
                                                            <th>Payment Status</th>
                                                            <th>Bank Slip</th>
                                                            <th>Booking Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    include './auth.php';
                                                    $re = mysql_query("SELECT * FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 WEEK)) and (NOW()) AND isCocoylandia=0");

                                                    if(mysql_num_rows($re) > 0){
                                                        while($row = mysql_fetch_array($re)){
                                                            if($row['bank_slip']!=null)
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td><a data-fancybox="gallery" href="../' . $row['bank_slip'] . '"><img src="../' . $row['bank_slip'] . '" style="height:50px;width:50px;"></a></td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                            else
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td>None</td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                $row = mysql_fetch_array(mysql_query("SELECT SUM(amount_paid) FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 WEEK)) and (NOW()) AND isCocoylandia=0"));
                                                echo '<h5>TOTAL: ₱ <b>'.number_format(array_sum($row)).'</b></h5>' 
                                                ?>
                                            </div>
                                        </div>
                                        <div id="daily">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="dailytable">
                                                    <thead>
                                                        <tr>
                                                            <th>Reservation Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Total bill</th>
                                                            <th>Amount Paid</th>
                                                            <th>Payment Status</th>
                                                            <th>Bank Slip</th>
                                                            <th>Booking Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    include './auth.php';
                                                    $re = mysql_query("SELECT * FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 DAY)) and (NOW()) AND isCocoylandia=0");

                                                    if(mysql_num_rows($re) > 0){
                                                        while($row = mysql_fetch_array($re)){
                                                            if($row['bank_slip']!=null)
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td><a data-fancybox="gallery" href="../' . $row['bank_slip'] . '"><img src="../' . $row['bank_slip'] . '" style="height:50px;width:50px;"></a></td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                            else
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td>None</td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                $row = mysql_fetch_array(mysql_query("SELECT SUM(amount_paid) FROM booking WHERE booking_date BETWEEN (DATE_ADD(NOW(), INTERVAL -1 DAY)) and (NOW()) AND isCocoylandia=0"));
                                                echo '<h5>TOTAL: ₱ <b>'.number_format(array_sum($row)).'</b></h5>' 
                                                ?>
                                            </div>
                                        </div>
                                        <div id="custom">
                                            <form method="POST">
                                                Range:
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        From: 
                                                        <input class="form-control hasDatepicker" readonly type="text" id="rangeFrom" name="rangeFrom">
                                                    </div>
                                                    <div class="col-md-5">
                                                        To: 
                                                        <input class="form-control hasDatepicker" readonly type="text" id="rangeTo" name="rangeTo">
                                                    </div>
                                                </div>
                                                <br><div class="col-md-5 col-md-offset-5"><button class="btn btn-success" type="submit" name="generateReportCustom">Generate</button></div></form>
                                                <br/><br/><div class="table-responsive">
                                                <table class="table table-striped" id="customtable">
                                                    <thead>
                                                        <tr>
                                                            <th>Reservation Code</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Total bill</th>
                                                            <th>Amount Paid</th>
                                                            <th>Payment Status</th>
                                                            <th>Bank Slip</th>
                                                            <th>Booking Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    include './auth.php';

                                                    if(isset($_POST)){
                                                        $rangeFrom = date_format(date_create($_POST['rangeFrom']),"Y-m-d");
                                                        $rangeTo = date_format(date_create($$_POST['rangeTo']),"Y-m-d");
                                                        $re = mysql_query("SELECT * FROM booking WHERE booking_date BETWEEN '$rangeFrom' and '$rangeTo' AND isCocoylandia=0");

                                                    if(mysql_num_rows($re) > 0){
                                                        while($row = mysql_fetch_array($re)){
                                                            if($row['bank_slip']!=null)
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td><a data-fancybox="gallery" href="../' . $row['bank_slip'] . '"><img src="../' . $row['bank_slip'] . '" style="height:50px;width:50px;"></a></td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                            else
                                                            echo '
                                                                <tr>
                                                                    <td>'.$row['reservation_code'].'</td>
                                                                    <td>'.$row['first_name'].'</td>
                                                                    <td>'.$row['last_name'].'</td>
                                                                    <td>₱ '.$row['total_amount'].'</td>
                                                                    <td>₱ '.$row['amount_paid'].'</td>
                                                                    <td>'.$row['payment_status'].'</td>
                                                                    <td>None</td>             
                                                                    <td>'.$row['booking_date'].'</td>          
                                                                </tr>
                                                                ';
                                                        }
                                                    }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                if(isset($_POST)){
                                                    $rangeFrom = date_format(date_create($_POST['rangeFrom']),"Y-m-d");
                                                    $rangeTo = date_format(date_create($$_POST['rangeTo']),"Y-m-d");


                                                    $row = mysql_fetch_array(mysql_query("SELECT SUM(amount_paid) FROM booking WHERE booking_date BETWEEN '$rangeFrom' and '$rangeTo' AND isCocoylandia=0"));
                                                    echo '<h5>TOTAL: ₱ <b>'.number_format(array_sum($row)).'</b></h5>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
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
				<a href="#">Montalban Waterpark and Garden Resort</a>.</strong> All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#alltable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
        $('#annualtable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
        $('#monthlytable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
        $('#weeklytable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
        $('#dailytable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
        $('#customtable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
        
    });

    $('.deletebtn').click (function () {
		return confirm ("Are you sure you want to delete?") ;
	}); 
    </script>
    <script type="text/javascript">
    $(function() {
        $('input[name="rangeFrom"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        $('input[name="rangeTo"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        var x = localStorage.getItem('salesreport-activetab');
        if(x!=null){
            $("#tabs").tabs({ active: x });
        }
    });

    $('#tabs').tabs({
        activate: function(event, ui){
            localStorage.setItem('salesreport-activetab',ui.newTab.index());
        }
    });
    </script>
	<!-- REQUIRED JS SCRIPTS -->
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>

</body>

</html>