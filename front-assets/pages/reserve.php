	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- TITLE -->
		<title>Choose Room</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="shortcut icon" href="VeneracionDesign/images/favicon.png"/>

		<!-- GOOGLE FONT -->
		<link href='http://fonts.googleapis.com/css?family=Hind:400,300,500,600%7cMontserrat:400,700' rel='stylesheet' type='text/css'>

		<!-- CSS LIBRARY -->
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/font-lotusicon.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/owl.carousel.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/magnific-popup.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/settings.css">
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/lib/bootstrap-select.min.css">
		<!-- SWAL -->
		<script src="dist/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<!-- MAIN STYLE -->
		<link rel="stylesheet" type="text/css" href="VeneracionDesign/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		 <script src='http://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js'></script>
		 
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
			<link rel="stylesheet" type="text/css" href="../css/style.css"/>
		  <link rel="stylesheet" href="../css/navstyle.css">
		 <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		  <script src="../js/navstyle.js"></script>
			<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>
			<link rel="stylesheet" href="../css/roomstyle.css">
		   
			
		
	</head>

	<!--[if IE 7]> <body class="ie7 lt-ie8 lt-ie9 lt-ie10"> <![endif]-->
	<!--[if IE 8]> <body class="ie8 lt-ie9 lt-ie10"> <![endif]-->
	<!--[if IE 9]> <body class="ie9 lt-ie10"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<body>
		<!-- PRELOADER -->
		<div id="preloader">
			<span class="preloader-dot"></span>
		</div>
		<!-- END / PRELOADER -->

		<!-- PAGE WRAP -->
		<div id="page-wrap">

			<!-- HEADER -->
			 <header id="header" class="header-v2">
		
			</header>
			<!-- END / HEADER -->
			
			<!-- SUB BANNER -->
			<section class="section-sub-banner bg-9">
				<div class="awe-overlay"></div>
				<div class="sub-banner">
					<div class="container">
						<div class="text text-center">
							<h2>Montalban Waterpark</h2>
						</div>
					</div>

				</div>

			</section>
		  
	<section class="section-reservation-page">
				 <div class="container">
					<div class="reservation-page">
					

						<!-- STEP -->
						
						<!-- END / STEP -->

						<div class="row">
				<?php
					include("php_connect.php");
					session_start();
							$guest = $_SESSION["res_guest"];
					$in = $_SESSION["res_in"];
					$in_ = date_create($in);
					$in__ = date_format($in_, "Y-m-d");
					$out = $_SESSION["res_out"];
					$out_ = date_create($out);
					$out__ = date_format($out_, "Y-m-d");
					$outx = date_format($out_, "F j, Y");
					$inx = date_format($in_, "F j, Y");
					
					
				 ?>
									<div class="reservation-sidebar_availability bg-gray">
					
										<!-- HEADING -->
										<h2 class="reservation-heading">YOUR RESERVATION</h2>
										<!-- END / HEADING -->

										<h6 class="check_availability_title">your stay dates</h6>

										<div class="check_availability-field">
											<label>Arrive</label>
											<input type="text" id="in" readonly name="in" style="background-color: transparent; border:0pc" value="<?php echo $inx; ?>">
										</div>

										<div class="check_availability-field">
											<label>Departure</label>
											<input type="text" id="out" readonly name="out" style="background-color: transparent; border:0pc" value="<?php echo $outx; ?>">
											
										</div>
										
										 <div class="check_availability-field">
											<label>Guest/s</label>
											<input type="text"  id="guest" readonly name="guest" style="background-color: transparent; border:0pc" value="<?php echo $guest; ?>">
										</div>

																			
										
										<a href="<?php
					if(isset($_SESSION["bookCode"])){
						echo "modify_details.php";
					}
					else{
						echo "../../index.php";
					}?>"><button class="awe-btn awe-btn-13 data-toggle="modal" data-target=".bs-example-modal-sm">Edit 						 
						Details</button></a>
										 
									
									</div>
									</div>
									</div>
							<!-- SIDEBAR -->
							
							
							</div>
							<!-- END / SIDEBAR -->

							<!-- CONTENT -->
							
							<div class="col-md-6" style="margin-left:450px;margin-top:-470px;">
								<div class="reservation_content">
									<!-- RESERVATION ROOM -->
									 <div class="reservation-room" >
									 <div class="reservation-room_item">
									   <?php
					
						$sqlroom = "SELECT *, COUNT(*) as cntroom FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID GROUP BY room_type.RoomTypeID";
						$resroom = mysqli_query($conn, $sqlroom);
						$rowroom = mysqli_fetch_array($resroom);
						$cntroom = mysqli_num_rows($resroom);
					
						
						if(mysqli_num_rows($resroom) != 0){
						do{
						//sureball availability query		
						
						$sqlres = "SELECT *, COUNT(*) AS count FROM reservation JOIN room_reservation ON reservation.ReservationID=room_reservation.ReservationID JOIN room ON room_reservation.RoomNumber=room.RoomNumber JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE (('$out__' > reservation.CheckinDate AND '$out__' <= reservation.CheckoutDate) OR ('$in__' >= reservation.CheckinDate AND '$in__' < reservation.CheckoutDate) OR ('$in__' >= reservation.CheckinDate AND '$in__' < reservation.CheckoutDate) OR ('$out__' < reservation.CheckoutDate AND '$out__' >= reservation.CheckinDate) OR ('$in__' <= reservation.CheckinDate AND '$out__' >= reservation.CheckoutDate)) AND reservation.Status IN ('PENDING', 'PAID', 'WAITING') GROUP BY Description";
						
						
						//to be edited
						$sqlchk = "SELECT *, COUNT(*) as countchkin FROM room LEFT JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room.Status!='AVAILABLE' GROUP BY room_type.Description";
						
						$res = mysqli_query($conn, $sqlres);
						$row = mysqli_fetch_array($res);
						
						$resx = mysqli_query($conn, $sqlchk);
						$rowx = mysqli_fetch_array($resx);
								$cnt = $rowroom["cntroom"];
								if(mysqli_num_rows($res) > 0){
									do{
										if($rowroom["Description"] == $row["Description"]){
											$cnt -= $row["count"];
										}
									}while($row = mysqli_fetch_array($res));
								}
								if(mysqli_num_rows($resx) > 0){
									do{
										if($rowroom["Description"] == $rowx["Description"]){
											$cnt -= $rowx["countchkin"];
										}
									}while($rowx = mysqli_fetch_array($resx));
								}
								if($cnt > 0){
						?>

	<!-- ############## STANDARD ################ -->
	

	<div class="row">
	  <section class="room" style="background:white;" >
	 
		  <form id="formid">
	   <!-- Room Image -->
		<div class="room_img">
		  <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $rowroom['RoomPic'] ).''; ?>" width="100%" height="auto" />
		</div>
		<h2 class="room_information--heading">&nbsp;&nbsp;<?php echo $rowroom["Description"]; ?></h2>  
		<!-- Room Information -->      
		<div class="room_information">
		  
		  <p><?php echo $rowroom["AboutRoom"]; ?></p>
		  <h2><?php echo $cnt; ?> Available Room(s)</h2>
		  <h2>Number of Rooms&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <select class="quan" style="width:30%; text-align: right;height:30px;border-radius: 5px;" id="<?php echo $rowroom["RoomTypeID"]."nr"; ?>">
			  <?php
			  for($i = 0; $i <= $cnt; $i++){
			?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
			  }
			  ?>
		  </select>
		  </h2>
		  
		  <input id="<?php echo $rowroom["RoomTypeID"]."cap"; ?>" type="number" class="totalcap" value="0" hidden>
			<input id="<?php echo $rowroom["RoomTypeID"]."ses"; ?>" type="text" class="forsess" value="0,<?php echo $rowroom["RoomTypeID"]; ?>" hidden>
		</div>

		<div class="room_features">
		 <ul class="info-icons">
			<li class="icons"><i class="fa fa-bed"></i>&nbsp;<?php echo $rowroom["Beds"]; ?></li> <!-- Bath Icon -->
			<li class="icons"><i class="fa fa-male"></i>&nbsp;<span id="<?php echo $rowroom["RoomTypeID"]; ?>c"><?php echo $rowroom["Capacity"]; ?></span></li> <!-- People Icon -->
			<li class="icons"><i class="fa fa-tv"></i>&nbsp;<?php echo $rowroom["TV"]; ?></li> <!-- Price -->
		</ul> 
			<a style="cursor: default;" href="javascript:void(0);" class="room_features--book-btn"><?php echo "P".number_format($rowroom["Price"],2); ?> / NIGHT</a> <!-- P1,000 / NIGHT -->
		</div>  
		
		
		  <script>
						$("#<?php echo $rowroom["RoomTypeID"]; ?>nr").change(function() {
							var totalcap = parseInt($("#<?php echo $rowroom["RoomTypeID"]; ?>nr").val()) * parseInt($("#<?php echo $rowroom["RoomTypeID"]; ?>c").html());
							var valOfRm = $("#<?php echo $rowroom["RoomTypeID"]; ?>nr").val();
							$("#<?php echo $rowroom["RoomTypeID"]; ?>cap").val(totalcap);
							$("#<?php echo $rowroom["RoomTypeID"]; ?>ses").val(valOfRm+","+<?php echo $rowroom["RoomTypeID"]; ?>);
							
						});
						
					</script>
		</form>
	  </section>
	</div>  
	<!-- /row-->

	<?php
			}
							}while($rowroom = mysqli_fetch_array($resroom));
						}
	?>
			<br><br><br><br><br>
		  <div class="col-lg-12">
					<center>
					<button class="awe-btn awe-btn-13" onclick="validate()">Confirm Reservation</button>
					</center>
						</div>
									</div>
									</div>
									<!-- END / RESERVATION ROOM -->
								</div>
							</div>
							<!-- END / CONTENT -->
						   
						</div>
					</div>
				</div>

			</section>      
		   
		  
		 
			

			<!-- FOOTER -->
			<footer id="footer">

				<!-- FOOTER BOTTOM -->
				<div class="footer_bottom">
					<div class="container">
						<p>&copy; 2017 Montalban Waterpark and Garden Resort All rights reserved.</p>
					</div>
				</div>
				<!-- END / FOOTER BOTTOM -->

			</footer>
			<!-- END / FOOTER -->

		</div>
		<!-- END / PAGE WRAP -->


		<!-- LOAD JQUERY -->
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery-ui.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/bootstrap.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/bootstrap-select.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/isotope.pkgd.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/owl.carousel.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.appear.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.countTo.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.countdown.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.parallax-1.1.3.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/lib/SmoothScroll.js"></script>
		<script type="text/javascript" src="VeneracionDesign/js/scripts.js"></script>
		<script>


		
	function validate(){
		//check if there is a room selected.
		//check if it does not exceed max room.
		
		
		
		var maxminval = false;
		
		/*
		$( ".quan" ).each(function( index ) {
			var max_ = $(this).attr("max");
			var min_ = $(this).attr("min");
			var val_ = $(this).val();
			
			
			//check min and max value
			if(!(val_ >= min_ && val_ <= max_)){ //if not satisfied -> focus the input box
				//change ctr -> for the message box (swal)
				$(this).attr("style", "border: 1px solid red; width:50%; text-align: right");
				maxminval = true;
			}
				
		});
		*/

		var sum = 0;
		var mess = "";
		var submess = "";
		
		var sumcap = 0;
		var guest = $("#guest").val();
		
		$('.quan').each(function(){
			 sum += parseInt($(this).val());
		});
		
		$('.totalcap').each(function(){
			 if ($(this).val() != "") {
				sumcap += parseInt($(this).val());
			}
		});
		
		
		if(sum == 0){ //check
			mess = "No room selected yet!";
			submess = "There must be atleast 1 room selected";
			swal(mess, submess, "warning");
		}
		else if(maxminval){ //check
			mess = "Check inputs!";
			submess = "Number of rooms must be greater than or equal to 0 and less than or equal to the available number of rooms";
			swal(mess, submess, "warning");
		}
		
		/*
		else if(sumcap < guest){ //check
			mess = "The rooms cannot accommodate number of guest.";
			submess = "Check room capacity."
			swal(mess, submess, "warning");
		}
		*/
		
		else{
			
				var indate = $("#in").val();
				var outdate = $("#out").val();
				var guest = $("#guest").val();
				var numperroom = "";
				$(".forsess").each(function() {
					numperroom += $(this).val() + ";";
				});
			
			//for sessions
			$.ajax({
				url: "session_reservation.php",
				method: "post",
				data: {
					indate_post : indate,
					outdate_post : outdate,
					guest_post : guest,
					numperroom_post : numperroom
				},
				success: function(){
					window.location.href="confirm.php"; 
				}
			});
			
		}
	}

	</script>
		
	</body>
	</html>