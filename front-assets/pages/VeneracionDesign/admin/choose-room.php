<?php
session_start();
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
include './auth.php';
$re = mysql_query("SELECT * from admin WHERE username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "'");
echo mysql_error();
if (mysql_num_rows($re) > 0) {

} else {
    session_destroy();
    header("location: starter.php");
}

if (isset($_POST["checkIn"]) && !empty($_POST["checkIn"]) && isset($_POST["checkOut"]) && !empty($_POST["checkOut"])) {
    $_SESSION['checkin_date'] = date('M d, Y', strtotime($_POST['checkIn']));
    $_SESSION['checkout_date'] = date('M d, Y', strtotime($_POST['checkOut']));
    $_SESSION['checkin_db'] = date('y-m-d', strtotime($_POST['checkIn']));
    $_SESSION['checkout_db'] = date('y-m-d', strtotime($_POST['checkOut']));
    $_SESSION['datetime1'] = new DateTime($_SESSION['checkin_db']);
    $_SESSION['datetime2'] = new DateTime($_SESSION['checkout_db']);
    $_SESSION['checkin_unformat'] = $_POST["checkIn"];
    $_SESSION['checkout_unformat'] = $_POST["checkOut"];
    $_SESSION['interval'] = $_SESSION['datetime1']->diff($_SESSION['datetime2']);

    $_SESSION['total_night'] = $_SESSION['interval']->format('%d');
    if ($_SESSION['total_night'] == 0) {
        $_SESSION['total_night'] = 1;
    }
} else {
    header("location: starter.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cocoylandia Family Resort | Rooms</title>
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

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- fancyBox files -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Hind:400,300,500,600%7cMontserrat:400,700' rel='stylesheet' type='text/css'>

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
					<li class="active">
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
					Walk in
				</h1>
			</section>

			<!-- Main content -->
			<section class="content container-fluid">

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="add-walkin.php" class="btn btn-primary">Back</a>
                        </div>
                        <div class="panel-body">


                        <div class="row">
                        
                        
                        
                        <div class="col-md-3">

<div class="reservation-sidebar">

    <!-- SIDEBAR AVAILBBILITY -->
    <div class="reservation-sidebar_availability bg-gray">

        <!-- HEADING -->
        <h2 class="reservation-heading">YOUR RESERVATION</h2>
        <!-- END / HEADING -->

        <h6 class="check_availability_title">your stay dates</h6>

        <div class="check_availability-field">
            <label>Arrive</label>
            <?php echo $_SESSION['checkin_date']; ?>
        </div>

        <div class="check_availability-field">
            <label>Departure</label>
            <?php echo $_SESSION['checkout_date']; ?>
        </div>

        <form action="add-walkin.php" method="post">
        <button class="awe-btn awe-btn-13" type='submit'>EXIT RESERVATION</button>
        </form>
    </div>

    <!-- END / SIDEBAR AVAILBBILITY -->
</div>

</div>
<!-- END / SIDEBAR -->

<!-- CONTENT -->
<div class="col-md-6">
<div class="reservation_content">
    <!-- RESERVATION ROOM -->
    <div class="reservation-room">
        <?php
            include './auth.php';
            // check available room
            $datestart = date('y-m-d', strtotime($_SESSION['checkin_unformat']));
            $dateend   = date('y-m-d', strtotime($_SESSION['checkout_unformat']));
            $result    = mysql_query("SELECT
                r.room_id,
                (r.total_room - br.total) AS availableroom,
                isCocoylandia
            FROM room AS r
            LEFT JOIN (SELECT
                roombook.room_id,
                SUM(roombook.totalroombook) AS total
            FROM roombook
            WHERE roombook.booking_id IN (SELECT
                b.booking_id AS bookingID
            FROM booking AS b
            WHERE isCocoylandia = 0 AND ((b.checkin_date BETWEEN '" . $datestart . "' AND '" . $dateend . "')
            OR (b.checkout_date BETWEEN '" . $dateend . "' AND '" . $datestart . "')))
            
            GROUP BY roombook.room_id) AS br
                ON r.room_id = br.room_id
            WHERE isCocoylandia = 0");
            echo mysql_error();
            if (mysql_num_rows($result) > 0) {
                echo '<p><b>Choose Your Room</b></p><hr class="line">';
                print '<form action="billing-details.php" id="chooseroom" method="post"><div class="availability-form">';
                while ($row = mysql_fetch_array($result)) {
                    if ($row['availableroom'] != null && $row['availableroom'] > 0) {
                        $sub_result = mysql_query("SELECT room.* from room where room.room_id = " . $row['room_id'] . " ");
                        if (mysql_num_rows($sub_result) > 0) {
                            while ($sub_row = mysql_fetch_array($sub_result)) {
                                echo '<div class="reservation-room_item">
                                        <h2 class="reservation-room_name">
                                        <a href="#">' . $sub_row['room_name'] . '</a>
                                        </h2>
                                        <div class="reservation-room_img">
                                            <a data-fancybox="gallery" href="' . $sub_row['imgpath'] . '"><img src="../' . $sub_row['imgpath'] . '"></a>
                                        </div>
                                        <div class="reservation-room_text">
                                            <div class="reservation-room_desc">
                                                <p>' . $sub_row['descriptions'] . '</p>
                                            </div><p></p>
                                            <b><span class="reservation-room_amout">' . $row['availableroom'] . ' room(s) available</span></b>
                                            <div class="clear"></div>
                                            <p class="reservation-room_price">
                                                <span class="reservation-room_amout">₱ ' . $sub_row['rate'] . '</span> / days
                                            </p>
                                            <br/><br/>
                                    <span><b>No. of room: </b></span>
                                    <select class="form-control" name="qtyroom' . $sub_row['room_id'] . '" id="room' . $sub_row['room_id'] . '" onChange="selection(' . $sub_row['room_id'] . ')"  style="width:100%; color:black;" ;">
                                    <option  value="0">0</option>';
                                $i = 1;
                                while ($i <= $row['availableroom']) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                    $i = $i + 1;
                                }
                                echo '</select><br/>
                                        </div>
                                        <input type=hidden name="selectedroom' . $sub_row['room_id'] . '"  id="selectedroom' . $sub_row['room_id'] . '" value="' . $sub_row['room_id'] . '">
                                        <input type=hidden name="room_name' . $sub_row['room_id'] . '" id="room_name' . $sub_row['room_id'] . '" value="' . $sub_row['room_name'] . '">
                                        </div><hr/>';
                            }
                        }
                    } 
                    else if ($row['availableroom'] == null) {
                        $sub_result2 = mysql_query("SELECT room.* from room where room.room_id = " . $row['room_id'] . " ");
                        if (mysql_num_rows($sub_result2) > 0) {
                            while ($sub_row2 = mysql_fetch_array($sub_result2)) {
                                echo '<div class="reservation-room_item">
                                <h2 class="reservation-room_name">
                                <a href="#">' . $sub_row2['room_name'] . '</a>
                                </h2>
                                <div class="reservation-room_img">
                                    <a data-fancybox="gallery" href="' . $sub_row2['imgpath'] . '"><img src="../' . $sub_row2['imgpath'] . '"></a>
                                </div>
                                <div class="reservation-room_text">
                                    <div class="reservation-room_desc">
                                        <p>' . $sub_row2['descriptions'] . '</p>
                                    </div><p></p>
                                    <b><span class="reservation-room_amout">' . $sub_row2['total_room'] . ' room(s) available</span></b>
                                    <div class="clear"></div>
                                    <p class="reservation-room_price">
                                        <span class="reservation-room_amout">₱ ' . $sub_row2['rate'] . '</span> / days
                                    </p>
                                    <br/><br/>
                                    <span><b>No. of room: </b></span>
                                    <select class="form-control" name="qtyroom' . $sub_row2['room_id'] . '" id="room' . $sub_row2['room_id'] . '" onChange="selection(' . $sub_row['room_id'] . ')"  style="width:100%; color:black;" ;">
                                    <option  value="0">0</option>';
                                $i = 1;
                                while ($i <= $sub_row2['total_room']) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                    $i = $i + 1;
                                }
                                echo '</select><br/>
                                </div>
                                <input type=hidden name="selectedroom' . $sub_row2['room_id'] . '"  id="selectedroom' . $sub_row2['room_id'] . '" value="' . $sub_row2['room_id'] . '">
                                <input type=hidden name="room_name' . $sub_row2['room_id'] . '" id="room_name' . $sub_row2['room_id'] . '" value="' . $sub_row2['room_name'] . '">
                                </div> <hr/>';
                            }
                        }
                    }
                }
            } else {
                echo '<p><b>No room available</b></p><hr>';
                
            }
			
										//AMENITY
                                        $amenity = mysql_query("SELECT
                                            r.amenity_id,
                                            (r.quantity - br.total) AS availableroom,
                                            isCocoylandia
                                        FROM amenities AS r
                                        LEFT JOIN (SELECT
                                            amenitybook.amenity_id,
                                            SUM(amenitybook.totalamenitybook) AS total
                                        FROM amenitybook
                                        WHERE amenitybook.booking_id IN (SELECT
                                            b.booking_id AS bookingID
                                        FROM booking AS b
                                        WHERE isCocoylandia = 1 AND ((b.checkin_date BETWEEN '" . $datestart . "' AND '" . $dateend . "')
                                        OR (b.checkout_date BETWEEN '" . $dateend . "' AND '" . $datestart . "')))
                                        
                                        GROUP BY amenitybook.amenity_id) AS br
                                            ON r.amenity_id = br.amenity_id
                                        WHERE isCocoylandia = 1");
                                        echo mysql_error();
                                        if (mysql_num_rows($amenity) > 0) {
                                            echo '<p><b>Choose Your Amenities</b></p><hr class="line">';
                                            while ($row = mysql_fetch_array($amenity)) {
                                                if ($row['availableroom'] != null && $row['availableroom'] > 0) {
                                                    $sub_result = mysql_query("SELECT amenities.* from amenities where amenities.amenity_id = " . $row['amenity_id'] . " ");
                                                    if (mysql_num_rows($sub_result) > 0) {
                                                        while ($sub_row = mysql_fetch_array($sub_result)) {
                                                            echo '<div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="amenity'.$sub_row['amenity_id'].'" name="amenity'.$sub_row['amenity_id'].'">
                                                                <label class="form-check-label" for="amenity'.$sub_row['amenity_id'].'">'. $sub_row['amenity_name'].' - PHP '.$sub_row['price']. '('.$row['availableroom'].' remaning)</label>
                                                            </div>';
                                                            echo '<input type=hidden name="selectedamenity' . $sub_row['amenity_id'] . '"  id="selectedamenity' . $sub_row['amenity_id'] . '" value="' . $sub_row['amenity_id'] . '">
                                                            <input type=hidden name="amenity_name' . $sub_row['amenity_id'] . '" id="amenity_name' . $sub_row['amenity_id'] . '" value="' . $sub_row['amenity_name'] . '">
                                                            <input type=hidden name="amenity_rate' . $sub_row['amenity_id'] . '" id="amenity_rate' . $sub_row['amenity_id'] . '" value="' . $sub_row['price'] . '">
                                                            ';
                                                        }
                                                    }
                                                } 
                                                else if ($row['availableroom'] == null) {
                                                    $sub_result2 = mysql_query("SELECT amenities.* from amenities where amenities.amenity_id = " . $row['amenity_id'] . " ");
                                                    if (mysql_num_rows($sub_result2) > 0) {
                                                        while ($sub_row2 = mysql_fetch_array($sub_result2)) {
                                                            echo '<div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="amenity'.$sub_row2['amenity_id'].'" name="amenity'.$sub_row2['amenity_id'].'">
                                                                <label class="form-check-label" for="amenity'.$sub_row2['amenity_id'].'">'. $sub_row2['amenity_name'].' - PHP '.$sub_row2['price'].' ('.$sub_row2['quantity'].' remaining)</label>
                                                            </div>';
                                                            echo '<input type=hidden name="selectedamenity' . $sub_row2['amenity_id'] . '"  id="selectedamenity' . $sub_row2['amenity_id'] . '" value="' . $sub_row2['amenity_id'] . '">
                                                            <input type=hidden name="amenity_name' . $sub_row2['amenity_id'] . '" id="amenity_name' . $sub_row2['amenity_id'] . '" value="' . $sub_row2['amenity_name'] . '">
                                                            <input type=hidden name="amenity_rate' . $sub_row2['amenity_id'] . '" id="amenity_rate' . $sub_row2['amenity_id'] . '" value="' . $sub_row2['price'] . '">
                                                            ';
                                                        }
                                                    }
                                                }
                                               
                                            }
                                        } else {
                                            echo '<p><b>No amenity available</b></p><hr>';
                                            
                                        }
                                        print '</form></div>';

        ?>
    </div>
    <!-- END / RESERVATION ROOM -->
</div>
</div>
<!-- END / CONTENT -->
<div class="col-md-3">
        <div class="reservation-sidebar_availability bg-gray" id="roomselected" style="display:none;">
        <!-- <label for="submit-form" class="awe-btn awe-btn-13" ">Proceed To Book
        </label> -->
        <button type="button" name="submit" class="awe-btn awe-btn-13" onClick="submitForm()">BOOK NOW</button>
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
				<a href="#">Cocoylandia Family Resort</a>.</strong> All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->
    <script type="text/javascript">
    $(function() {
        $('input[name="rangeFrom"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            startDate: new Date(),
            minDate: new Date()
        });
        $('input[name="rangeTo"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: new Date(),
            startDate: new Date()
            
        });
    });
    </script>
        <script>
    function selection(id) {
        debugger;
        if(this.value!=0){
            var e = document.getElementById('roomselected').style.display='block';
        }
        else
            var e = document.getElementById('roomselected').style.display='hidden';

    }
    function submitForm() {
        var x= document.getElementById("chooseroom");
        x.submit();
    }
    </script>
	<!-- REQUIRED JS SCRIPTS -->
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>

</body>

</html>