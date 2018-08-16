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

if (!isset($_SESSION['room_id'])) {
    $_SESSION['room_id'] = array();
    $_SESSION['roomname'] = array();
    $_SESSION['roomqty'] = array();
    $_SESSION['guestqty'] = array();
    $_SESSION['ind_rate'] = array();
    $_SESSION['total_amount'] = 0;
    $_SESSION['deposit'] = 0;
}

$result = mysql_query("SELECT * from room WHERE isCocoylandia = 0");
if (mysql_num_rows($result) > 0) {
    $count = 0;
    while ($row = mysql_fetch_array($result)) {
        if (isset($_POST["qtyroom" . $row['room_id'] . ""]) && !empty($_POST["qtyroom" . $row['room_id'] . ""])) {
            // if (isset($_POST["qtyguest" . $row['room_id'] . ""]) && !empty($_POST["qtyguest" . $row['room_id'] . ""])) {
            $_SESSION['room_id'][$count] = $_POST["selectedroom" . $row['room_id'] . ""];
            $_SESSION['roomqty'][$count] = $_POST["qtyroom" . $row['room_id'] . ""];
            $_SESSION['guestqty'][$count] = 1;
            $_SESSION['roomname'][$count] = $_POST["room_name" . $row['room_id'] . ""];
            $_SESSION['ind_rate'][$count] = $row['rate'] * $_POST["qtyroom" . $row['room_id'] . ""];
            $_SESSION['total_amount'] = ($row['rate'] * $_POST["qtyroom" . $row['room_id'] . ""] * $_SESSION['total_night']) + $_SESSION['total_amount'];
            $_SESSION['deposit'] = $_SESSION['total_amount'] * 0.20;
            $count = $count + 1;
            // }
        }
    }

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

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"
        />

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
                        <b>ADM</b>
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <b>ADMIN</b>
                    </span>
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
                                    <span class="hidden-xs">
                                        <?php echo $_SESSION['username'] ?>
                                    </span>
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
                            <p>
                                <?php echo $_SESSION['username'] ?>
                            </p>
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
                                        
                            <!-- SIDEBAR -->
                            <div class="col-md-3">

<div class="reservation-sidebar">

    <!-- RESERVATION DATE -->
    <div class="reservation-date bg-gray">

        <!-- HEADING -->
        <h2 class="reservation-heading">Dates</h2>
        <!-- END / HEADING -->

        <ul>
            <li>
                <span>Check-In</span>
                <span>
                    <?php echo $_SESSION['checkin_date']; ?>
                </span>
            </li>
            <li>
                <span>Check-Out</span>
                <span>
                    <?php echo $_SESSION['checkout_date']; ?>
                </span>
            </li>
            <li>
                <span>Total Nights</span>
                <span>
                    <?php echo $_SESSION['total_night']; ?>
                </span>
            </li>
            <li>
                <span>Total Rooms</span>
                <span>
                    <?php echo array_sum($_SESSION['roomqty']); ?> of
                    <?php echo array_sum($_SESSION['roomqty']); ?>
                </span>
            </li>
        </ul>

    </div>
    <!-- END / RESERVATION DATE -->
</div>

</div>
<!-- END / SIDEBAR -->

<!-- CONTENT -->
<div class="col-md-6">

<div class="reservation_content">

    <div class="reservation-billing-detail">

        <!-- <p class="reservation-login">Returning customer?
        <a href="#">Click here to login</a>
    </p> -->
        <form action='emailconfirmation.php' method='post' onSubmit='return validateForm(this);'>
            <h4>BILLING DETAILS</h4>

            <!-- <label>Country
                <sup>*</sup>
            </label>
            <select class="awe-select hidden" name="country" id="country">
                <option>Philippines</option>
                <option>United States</option>
            </select> -->

            <div class="row">
                <div class="col-sm-6">
                    <label>First Name
                        <sup>*</sup>
                    </label>
                    <input required class="input-text" name="firstname" pattern="[A-Za-z]{1,50}" onkeypress="return blockSpecialChar(event)" type="text" value="<?php if (isset($_SESSION['firstname']) && !empty($_SESSION['firstname'])) {echo $_SESSION['firstname'];}?>"
                        pattern="[a-zA-Z\s]+" Title="Max 50 characters" placeholder="e.g. Juan"
                    />
                </div>
                <div class="col-sm-6">
                    <label>Last Name
                        <sup>*</sup>
                    </label>
                    <input required class="input-text" name="lastname" pattern="[A-Za-z]{1,50}" onkeypress="return blockSpecialChar(event)" type="text" value="<?php if (isset($_SESSION['lastname']) && !empty($_SESSION['lastname'])) {echo $_SESSION['lastname'];}?>"
                        pattern="[a-zA-Z\s]+" Title="Max 50 characters" placeholder="e.g. Dela Cruz"
                    />
                </div>
            </div>

            <label>Address Line 1
                <sup>*</sup>
            </label>
            <input required class="input-text" name="addressline1" pattern=".{1,50}" maxlength="50" type="text" Title="Max 50 characters" value="<?php if (isset($_SESSION['addressline1']) && !empty($_SESSION['addressline1'])) {echo $_SESSION['addressline1'];}?>"
                placeholder="" />
            <label>Address Line 2
            </label>
            <input class="input-text" name="addressline2" maxlength="50" pattern=".{1,50}" type="text" Title="Max 50 characters" value="<?php if (isset($_SESSION['addressline2']) && !empty($_SESSION['addressline2'])) {echo $_SESSION['addressline2'];}?>"
                placeholder="" / />

            <div class="row">
                <div class="col-sm-6">
                    <label>Town / City
                        <sup>*</sup>
                    </label>
                    <input required class="input-text" name="city" type="text" value="<?php if (isset($_SESSION['city']) && !empty($_SESSION['city'])) {echo $_SESSION['city'];}?>"
                        pattern="[a-zA-Z0-9\s]+" Title="Special characters such as ( ) * & ^ % $ & etc are not allowed"
                        placeholder="" / />
                </div>
                <div class="col-sm-6">
                    <label>Zip/Postcode
                        <sup></sup>
                    </label>
                    <input class="input-text" name="postcode" id="postcode" type="number" pattern=".{4,4}" value="<?php if (isset($_SESSION['postcode']) && !empty($_SESSION['postcode'])) {echo $_SESSION['postcode'];}?>"
                        placeholder="e.g. 1600" / />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label>Email Address
                        <sup>*</sup>
                    </label>
                    <input required class="input-text" name="email" type="email" value="<?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {echo $_SESSION['email'];}?>"
                        placeholder="" />
                </div>
                <div class="col-sm-6">
                    <label>Phone
                        <sup>*</sup>
                    </label>
                    <input required class="input-text" name="phone" id="phone" type="number" value="<?php if (isset($_SESSION['phone']) && !empty($_SESSION['phone'])) {echo $_SESSION['phone'];}?>"
                        pattern="[a-zA-Z0-9\s]+" Title="Special characters such as ( ) * & ^ % $ & etc are not allowed"
                        placeholder="" / />
                </div>
            </div>
            <button class="awe-btn awe-btn-13" type="submit">PLACE ORDER</button>
        </form>
    </div>

</div>

</div>

<div class="col-md-3">
<!-- ROOM SELECT -->
<div class="reservation-room-selected bg-gray">

    <!-- HEADING -->
    <h2 class="reservation-heading">Selected Rooms</h2>
    <!-- END / HEADING -->

    <!-- ITEM -->
    <?php
$no = 1;
for ($i = 0; $i < count($_SESSION['room_id']); $i++) {

    echo '
                                            <div class="reservation-room-seleted_item">

                                            <h6>ROOM ' . $no . '</h6>
                                            <span class="reservation-option">' . $_SESSION['guestqty'][$i] . ' Guest</span>&nbsp;
                                            <span class="reservation-option">' . $_SESSION['roomqty'][$i] . ' Room</span>&nbsp;
                                            <span class="reservation-option">' . ($_SESSION['ind_rate'][$i] / $_SESSION['roomqty'][$i]) . '/day</span>
                                            <div class="reservation-room-seleted_name has-package">
                                                <h2>
                                                    <a>' . $_SESSION['roomname'][$i] . '</a>
                                                </h2>
                                            </div>

                                            <div class="reservation-room-seleted_package">
                                                <h6>RATE</h6>
                                                <ul>';
    for ($x = 1; $x <= $_SESSION['total_night']; $x++) {
        $date = strtotime('+' . $x . ' day', strtotime($_SESSION['checkin_unformat']));
        echo '
                                                    <li>
                                                        <span>' . date("M d, Y", $date) . '  ' . $_SESSION['roomqty'][$i] . ' x ₱' . number_format(($_SESSION['ind_rate'][$i] - $_SESSION['ind_rate'][$i]*.12 ) / $_SESSION['roomqty'][$i]) . '</span>
                                                        <span>₱' . number_format(($_SESSION['ind_rate'][$i] - $_SESSION['ind_rate'][$i]*.12)) . '</span>
                                                    </li>';
    }

    echo '
                                                </ul>
                                            </div>

                                            <div class="reservation-room-seleted_total-room">
                                                TOTAL Room ' . $no . '
                                                <span class="reservation-amout">₱' . number_format(($_SESSION['ind_rate'][$i] - $_SESSION['ind_rate'][$i]*.12 ) * $_SESSION['total_night']) . '.00</span>
                                            </div>

                                            </div> ';
    $no += 1;
}
?>
        <!-- END / ITEM -->
										<!-- TAX -->
                                        <div class="reservation-room-seleted_item">
                                                        <span>Tax</span>
                                                        <span class="pull-right">₱ <?php echo number_format(($_SESSION['total_amount'] * .12), 0) ?>.00</span>
                                        </div>
										<!-- TOTAL -->
        <div class="reservation-room-seleted_total bg-blue">
            <label>TOTAL</label>
            <span class="reservation-total">₱
                <?php echo $_SESSION['total_amount']; ?>.00</span>
        </div>
        <!-- END / TOTAL -->

</div>
<!-- END / ROOM SELECT -->
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
        <script>
            function validateForm(form) {
                var fname = form.firstname.value;
                var lname = form.lastname.value;
                var email = form.email.value;
                var phone = form.phone.value;
                var add1 = form.addressline1.value;
                var postcode = form.postcode.value;
                var city = form.city.value;
                var state = form.state.value;
                var country = form.country.value;
                if (fname == null || lname == null || email == null || phone == null || add1 == null || postcode == null || city == null || state == null || country == null || fname == "" || lname == "" || email == "" || phone == "" || add1 == "" || postcode == "" || city == "" || state == "" || country == "") {
                    alert("Please fill in all the fields mark with *.");

                    return false;
                }

            }
        </script>
        <script type="text/javascript">
        function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 );
        }
        </script>
        <script>
            $(function() {
                $('#postcode').keyup( function(e){
                if ($(this).val().length >= 4) { 
                    $(this).val($(this).val().substr(0, 4));
                }
                });
                $('#phone').keyup( function(e){
                    if ($(this).val().length >= 11) { 
                        $(this).val($(this).val().substr(0, 11));
                    }
                });
                $("#postcode").keypress(function(event) {
                    if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
                        return false;
                    }
                });
            });
        </script>
        <!-- REQUIRED JS SCRIPTS -->
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>

    </body>

    </html>