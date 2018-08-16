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
<body class="hold-transition skin-blue sidebar-mini" onload="updDate()">

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
      
	 
	   <div class="panel-heading" style="olo" >
	   <div class="row">
                <div class="col-md-10 col-md-offset-1" style="width:90%;">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
						
                        <div class="panel-body">
						<div class="box-body table-responsive no-padding">
    <?php
    include("con_reservationList.php");
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

$("#print").click(function () {
	window.location.href="<?php 
	if(isset($_GET["view"])){
		echo "print_resSlip.php?reprint=".$_GET["view"]; 
	}
	else{
		echo "print_resSlip.php";
	}
	?>";
});

$("#print_").click(function () {
	window.location.href="<?php 
	if(isset($_GET["rm2"])){
		echo "print_resSlip.php?save=".$_GET["rm2"]; 
	}
	else{
		echo "print_resSlip.php";
	}
	?>";
});


$("#next").click(function(){			
	//check if there is a room selected.
	//check if it does not exceed max room.
	var sum = 0;
	var mess = "";
	var submess = "";
	
	var sumcap = 0;
	var guest = <?php
		echo $_SESSION["ed_guest"];
	?>;
	
	$('.quan').each(function(){
         sum += parseInt($(this).val());
    });
	
	$('.totalcap').each(function(){
         if ($(this).val() != "") {
			sumcap += parseInt($(this).val());
		}
	});
	
	
	if(sum == 0){
		mess = "No room selected yet!";
		submess = "There must be atleast 1 room selected";
		swal(mess, submess, "warning");
	}
	/*
	else if(sumcap < guest){
		mess = "The rooms cannot accommodate number of guest.";
		submess = "Check room capacity."
		swal(mess, submess, "warning");
	}
	*/
	else{
		
			var numperroom = "";
			$(".forsess").each(function() {
				numperroom += $(this).val() + ";";
			});
			
		//for sessions
		$.ajax({
			url: "session_checkin_edit.php",
			method: "post",
			data: {
				numperroom_post : numperroom
			},
			success: function(){
				window.location.href="<?php 
				if(isset($_GET["rm"])){
					echo "reservation_list.php?rm2=".$_GET["rm"];
				}
				else{	
					echo "reservation_list.php";
				}
				 ?>";
			}
		});
		
	}
});


</script>

	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>

<!--js -->

<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>

</html>