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
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="dist/css/devStyle.css">
	<link rel="shortcut icon" href="images/favicon.png"/>

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
	
 <!-- SWAL -->
	<script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	
	
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
			
			<div class="row">
				<div id="MyDateDisplay" class="dateDisplay"></div>
				<div id="MyClockDisplay" class="clock"></div>
			</div>

		 
        <section class="content">
      <!-- Info boxes -->
		  <h3></h3>
      
	 
	   <div class="panel-heading" style="olo">
	   <div class="row">
                <div class="col-md-10 col-md-offset-1">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
						
                        <div class="panel-body">
						<div class="box-body table-responsive no-padding">
    <?php
    include("con_reservation.php");
    ?>
	</div>	
                        
                    </div>
                </div>
                </div>
   
		  
		 
           

            
		
	
		
		
			
			</section>
		
			<!-- /.content -->
		</div>
		<footer class="main-footer">
			<!-- To the right -->
			<!-- Default to the left -->
			<strong>Copyright &copy; 2017
				<a href="#">Montalban Waterpark and Garden Resort</a>.</strong> All rights reserved.
		</footer>
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		

	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->
</body>
<script>

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + (day);
	$('#txtDate').attr('min', maxDate);
	$('#txtDate').val(maxDate);
	
	var inDate = $("#txtDate").val();
	var inDate_ = new Date(inDate);
	var inDatex = inDate_.addDays(1);
    var month_ = inDatex.getMonth() + 1;
    var day_ = inDatex.getDate();
    var year_ = inDatex.getFullYear();
    if(month_ < 10)
        month_ = '0' + month_.toString();
    if(day_ < 10)
        day_ = '0' + day_.toString();
	var tomorrow = year_ + '-' + month_ + '-' + (day_);
	
	$('#txtDate').attr('min', tomorrow);
	$('#txtDate').val(tomorrow);
});

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

$(function(){
    var dtToday = new Date();
    dtToday = dtToday.addDays(3);
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + (day);
	$('#txtDate').attr('min', maxDate);
	$('#txtDate').val(maxDate);
	
	var inDate = $("#txtDate").val();
	var inDate_ = new Date(inDate);
	var inDatex = inDate_.addDays(1);
    var month_ = inDatex.getMonth() + 1;
    var day_ = inDatex.getDate();
    var year_ = inDatex.getFullYear();
    if(month_ < 10)
        month_ = '0' + month_.toString();
    if(day_ < 10)
        day_ = '0' + day_.toString();
	var tomorrow = year_ + '-' + month_ + '-' + (day_);
	
	$('#txtDateOut').attr('min', tomorrow);
	$('#txtDateOut').val(tomorrow);
});

function updDate(){
	var inDate = $("#txtDate").val();
	var inDate_ = new Date(inDate);
	var inDatex = inDate_.addDays(1);
    var month_ = inDatex.getMonth() + 1;
    var day_ = inDatex.getDate();
    var year_ = inDatex.getFullYear();
    if(month_ < 10)
        month_ = '0' + month_.toString();
    if(day_ < 10)
        day_ = '0' + day_.toString();
	var tomorrow = year_ + '-' + month_ + '-' + (day_);
	
	$('#txtDateOut').attr('min', tomorrow);
	$('#txtDateOut').val(tomorrow);
}
</script>
<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>

	<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->

<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>

</html>