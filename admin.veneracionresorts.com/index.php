<?php

include("weblock.php");
?><?php
//include("head.php");
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Montalban Waterpark and Garden Resort</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="css/lib/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="dist/css/devStyle.css">
	<link rel="shortcut icon" href="images/favicon_new.png"/>
	
	

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
		
		<!-- Left side column. contains the logo and sidebar -->
		<?php
		include("sidebar.php");
		?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- Main content -->
			<section class="content container-fluid">
			
			

			
        <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          
		  
		  <div class="info-box">
            <span class="info-box-icon bg-aqua"><image src="icon1.png"></span>

            <div class="info-box-content">
              <span class="info-box-text">Check-in Time</span>
				<div class="icon">
				
				</div>
              <span class="info-box-number"><?php
								        //for settings
								        include("php_connect.php");
                				        $intime = "SELECT * FROM settings WHERE SettingsID=1";
                						$resintime = mysqli_query($conn, $intime);
                						$rowintime = mysqli_fetch_array($resintime);
                						echo date_format(date_create($rowintime["StandardIn"]), "h:ia");
								    ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
         
        </div>
		
		<div class="col-md-3 col-sm-6 col-xs-12">
          
		  
		  <div class="info-box">
            <span class="info-box-icon bg-red" ><image src="icon2.png"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Check-out Time</span>
				<div class="icon">
				
				</div>
              <span class="info-box-number"><h4>
								    <?php
								    echo date_format(date_create($rowintime["StandardOut"]), "h:ia");
								    ?>
								</h4></span>
            </div>
            <!-- /.info-box-content -->
          </div>
         
        </div>
		
		
		<div class="col-md-3 col-sm-6 col-xs-12">
          
		  <a href="directory.php" style="color:black;">
		  <div class="info-box">
            <span class="info-box-icon bg-green"><image src="icon3.png"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Check-ins</span>
				<div class="icon">
				
				</div>
              <span class="info-box-number"> <?php
								    $cntroom = "SELECT COUNT(*) as cnt FROM room WHERE Status='IN-USE'";
                					$rescntroom = mysqli_query($conn,$cntroom);
                					$rowcntroom = mysqli_fetch_array($rescntroom);
                					echo $rowcntroom["cnt"];
								    ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
         </a>
        </div>
		
		<div class="col-md-3 col-sm-6 col-xs-12">
          
		   <a href="reservation_list.php" style="color:black;">
		  <div class="info-box">
            <span class="info-box-icon bg-aqua"><image src="icon4.png"></span>

            <div class="info-box-content">
              <span class="info-box-text">Reservations</span>
				<div class="icon">
				
				</div>
              <span class="info-box-number"><?php
                					$cntres = "SELECT COUNT(*) as cntres FROM reservation WHERE Status IN ('PAID', 'PENDING')";
                					$rescntres = mysqli_query($conn,$cntres);
                					$rowcntres = mysqli_fetch_array($rescntres);
                					echo $rowcntres["cntres"];
                				  ?>	</span>
            </div>
			 </a>
            <!-- /.info-box-content -->
          </div>
         
        </div>
		<div class="panel-heading" style="olo" >
	   <div class="row" >
                <div class="col-md-10 col-md-offset-1" style="width:90%;">
                
                    <div class="panel panel-default">
					<div class="table-responsive">
    <?php
    include("con_index.php");
    ?>
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