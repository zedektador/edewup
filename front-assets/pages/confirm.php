<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>Confirmation</title>

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

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="VeneracionDesign/css/style.css">
    
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>

<!--[if IE 7]> <body class="ie7 lt-ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 8]> <body class="ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]> <body class="ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->

    <!-- PRELOADER -->
    <div id="preloader">
        <span class="preloader-dot"></span>
    </div>
    <!-- END / PRELOADER -->

    <!-- PAGE WRAP -->
    <div id="page-wrap">

        <!-- HEADER -->
         <header id="header" class="header-v2">


            <!-- HEADER LOGO & MENU -->
            <div class="header_content" id="header_content">

                <div class="container">
                    <!-- HEADER LOGO -->
                    <!-- <div class="header_logo">
                        <a href="#"><img src="images/logo-header.png" alt=""></a>
                    </div> -->
                    <!-- END / HEADER LOGO -->

                    <!-- HEADER MENU -->
                    <nav class="header_menu">
                        <ul class="menu">
                        <?php
          //Copy this block of code IZA:
          session_start();
          if(isset($_SESSION["res_in"])){
          ?>
          
          
        
         
         <?php
         }
         //end of block of code
         ?>
                            <li>
                                <a href="../../index.php">Home</a>
                            </li>
                            <li>
                                <a href="about.php">About</a>
                            </li>
                            <li class="current-menu-item">
                                <a href="#">Room
                                    <span class="fa fa-caret-down"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="rooms.php">Rooms</a>
                                    </li>
                                    <li>
                                        <a href="cottages.php">Cottages</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="#">Reservation + 
                                    <span class="fa fa-caret-down"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="modify.php">Modify Reservation</a>
                                    </li>
                                    <li>
                                        <a href="submitproof.php">Submit Proof of Payment</a>
                                    </li>
                                </ul>
                            </li>
                        <li>
                            <li >
                                <a href="contactt.php">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- END / HEADER MENU -->

                    <!-- MENU BAR -->
                    <span class="menu-bars">
                        <span></span>
                    </span>
                    <!-- END / MENU BAR -->

                </div>
            </div>
            <!-- END / HEADER LOGO & MENU -->

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
        <!-- END / SUB BANNER -->
        
        <!-- ABOUT -->
        <section class="section-about">
        <div id="contact-container">
 
 
  <div class="icon_wrapper">
   
<div class="row">


                               

                                <div class="reservation-chosen-message bg-gray text-center" style="background-color:white;">
<h4>Montalban Waterpark and Garden Resort<br/> </h4>
<h5>0917-840-1155</h5>
<h5>veneracionresorts@gmail.com</h5>
  </div>

<?php
if(isset($_GET["success_"])){
    ?>
    
    	<div style="width: 70%; margin: auto; margin-top:150px; margin-bottom:150px;">
    	    	<center><h3 style=" color: #474544;
  font-size: 20px;
  font-weight: 600;
  text-align: center;
  text-transform: uppercase;">A message has been sent to your email address. Please click the link provided to confirm your reservation. Thank you!</h3>
    	    	<h5>Didn't get the email?</h5>
<h5>Check your junk mail or spam mail folder.</h5></center>
    	</div>
    
    <?php
}
elseif(isset($_GET["successx"])){
    ?>
    
    	<div style="width: 70%; margin: auto; margin-top:150px; margin-bottom:150px">
    	    	<center><h2>Your updated reservation slip has been sent to your email address. Thank you! </h2></center>
    	</div>
    
    <?php
}
else{
?>
</div>
</div>


                    
<div class="row">
<center>
<div class="col-md-8 col-lg-9">

                            <div class="reservation_content">

                                <div class="reservation-chosen-message bg-gray" style="background-color:white;">

<form action="save_reservation.php" method="post" id="contact_form">

    <?php
					if(isset($_SESSION["indate"])){
						include("php_connect.php");
						$in = $_SESSION["indate"];
						$out = $_SESSION["outdate"];
						$number = $_SESSION["guest"];
						$perroom = $_SESSION["numperroom"];
						$days = round((strtotime($out) - strtotime($in))/60/60/24);
					?>
				<div style="width: 90%; margin: auto;">
				<br>	  
					<center><h1>&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reservation Summary</h1></center>
					<br>
					<h4 style="margin-left:320px;">Booking Details</h4>
					<br>
					  
					<table style="width:100%;margin-left:250px;">
						<tr>
							<td style="width:30%; font-size: 18px; text-align: left;">Check-in Date: </td>
							<td style="width:70%; font-size: 18px; text-align: left;"><?php echo $in; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px; text-align: left;">Check-out Date: </td>
							<td style="width:70%; font-size: 18px; text-align: left;"><?php echo $out; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px; text-align: left;">Days: </td>
							<td style="width:70%; font-size: 18px; text-align: left;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px; text-align: left;">Guest(s): </td>
							<td style="width:70%; font-size: 18px; text-align: left;"><?php echo $number." pax"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px; text-align: left;">&nbsp;</td>
							<td style="width:70%; font-size: 18px; text-align: left;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px; font-weight: bold;text-align: left;">Room(s): </td>
							<td style="width:70%; font-size: 18px;text-align: left;">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px;text-align: left;">&nbsp;</td>
							<td style="width:70%; font-size: 18px;text-align: left;"></td>
						</tr>
						<tr>
								
								<td colspan=2>
								<table style="width:100%">
									<tr>
										<td style="width:20%; font-size: 18px;text-align: left;;">Room Type</td>
										<td style="width:20%; font-size: 18px;text-align: left;">Room Price</td>
										<td style="width:20%; font-size: 18px;text-align: left;">Quantity</td>
										<td style="width:20%; font-size: 18px;text-align: left;">Max. Guests</td>
										<td style="width:20%; font-size: 18px;text-align: left;">Amount</td>
									</tr>
								<?php
								$perroom = rtrim($perroom, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$additional = 0;
								$totalcap = 0;
								$remguest = $number;
								$matt = 0;
								foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									if($quantity != 0){
										//get room price
										$price = "SELECT * FROM room_type WHERE RoomTypeID=$roomnum";
										$res = mysqli_query($conn, $price);
										$row = mysqli_fetch_array($res);
										$roomtype = $row["Description"];
										$rprice = $row["Price"];
										$sub = $rprice * $days * $quantity;
										$cap = $row["Capacity"];
										$totalcap += $cap * $quantity;
										$matt += 2 * $quantity;
									?>
									<tr>
										<td style="width:20%; font-size: 18px;text-align: left;"><?php echo $roomtype; ?></td>
										<td style="width:20%; font-size: 18px;text-align: left;"><?php echo "Php ".number_format($rprice, 2); ?></td>
										<td style="width:20%; font-size: 18px;text-align: left;"><?php echo $quantity; ?></td>
										<td style="width:20%; font-size: 18px;text-align: left;"><?php echo $cap * $quantity; ?></td>
										<td style="width:20%; font-size: 18px;text-align: left;"><?php echo "Php ".number_format($sub, 2); ?></td>
									</tr>
									<?php
									$totalsub += $sub;
									}
								}
								?>
								</table>
								</td>
						</tr>	
						<tr>
							<td style="width:30%; font-size: 18px;text-align: left;">&nbsp;</td>
							<td style="width:70%; font-size: 18px;text-align: left;">&nbsp;</td>
						</tr>
						<?php   
						    $total_ = $totalsub + $additional;
							$ex = $number - $totalcap;
							if($matt < $ex){
							 ?>
							 <script>
                            		swal({
                                            title: "Room Cap Validation!",
                                            text: "We can't accommodate the given number of guests even with the inclusion of 2 mattresses per room selected. <?php echo $ex-$matt; ?> excess guests.",
                                            type: "warning",
                                            confirmButtonClass: "btn-danger",
                                          confirmButtonText: "Ok!",
                                          closeOnConfirm: false
                                        }, function() {
                                            window.location = "reserve.php";
                                        });
							 </script>
							 <?php
							}
							if($ex < 0){
							    $ex = 0;
							}
							if($ex > 0){
							    //get price of mattress from settings
							    $genmat = "SELECT * FROM settings WHERE SettingsID=1";
							    $resmat = mysqli_query($conn, $genmat);
							    $rowmat = mysqli_fetch_array($resmat);
							    $prmat = $rowmat["MattressPrice"];
						?>
						<tr>
							<td style="width:30%; font-size: 18px; font-weight: bold;text-align: left;">Note for Extra Persons: </td>
							<td style="width:70%; font-size: 18px;text-align: left;">
								&nbsp;
							</td>
						</tr>	
						<tr>
							<td style="width:30%; font-size: 18px;text-align: left;">&nbsp;</td>
							<td style="width:70%; font-size: 18px;text-align: left;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Extra Persons: </td>
							<td style="width:50%; font-size: 18px;text-align: left;"><?php echo $ex." pax"; ?></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Extra Mattress (Php <?php echo number_format($prmat, 2); ?> each): </td>
							<td style="width:50%; font-size: 18px;text-align: left;">
							    <input type="number" name="mat" style="width:50%; border:0px" id="mat" min="1" max="100" readonly value="<?php echo $ex; ?>">
							</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Additional Charges:</td>
							<td style="width:50%; font-size: 18px;text-align: left;">Php&nbsp; 
							    <input type="text" style="border:0px; width:50%" id="add" readonly value="<?php echo str_replace(",","",number_format($ex * $prmat, 2)); ?>">
							</td>
						</tr>
						<script>
						    $("#mat").on('keyup', function () {
						        var ch = parseFloat($("#mat").val());
						       
						        if(isNaN(ch)){
						            ch = 0;
						        }
						        if(ch <= 1){
						            ch = 1;
						        }
						        //var g = parseFloat($("#add").val());
						        var totalch = ch * <?php echo $prmat; ?>;
						        var vat = parseFloat((totalch + <?php echo $total_; ?>)/1.12).toFixed(2);
						        var vatx = parseFloat(((totalch + <?php echo $total_; ?>)/1.12)*0.12).toFixed(2);
						        var tot = parseFloat(totalch + <?php echo $total_; ?>).toFixed(2);
						        var t = parseFloat($("#totalz").val());
						        var newbal = parseFloat(tot - t).toFixed(2);
						        
						        $("#add").val(totalch);
						        $("#vat").val(vat);
						        $("#vatx").val(vatx);
						        $("#tot").val(tot);
						        $("#newbal").val(newbal);
						    });
						</script>
						<?php
							}
						?>
						<tr>
							<td style="width:30%; font-size: 18px;text-align: left;">&nbsp;</td>
							<td style="width:70%; font-size: 18px;text-align: left;">&nbsp;</td>
						</tr><tr>
							<td style="width:30%; font-size: 18px; font-weight:bold;text-align: left;">Payment Details</td>
							<td style="width:70%; font-size: 18px;text-align: left;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px;text-align: left;">&nbsp;</td>
							<td style="width:70%; font-size: 18px;text-align: left;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Total Room Fee:</td>
							<td style="width:50%; font-size: 18px;text-align: left;"><?php echo "Php &nbsp; ".number_format($totalsub, 2); ?></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Vatable Amount:</td>
							<td style="width:50%; font-size: 18px;text-align: left;">
							 Php&nbsp;<input type="number" style="border:0px; width:50%;font-size: 15px;" id="vat" readonly value="<?php 
							 echo str_replace(",", "", number_format(($total_ + ($prmat*$ex))/1.12, 2)); ?>"></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">VAT (12%):</td>
							<td style="width:50%; font-size: 18px;text-align: left;">
							       Php&nbsp;<input type="number" style="border:0px; width:50%;font-size: 15px;" id="vatx" readonly value="<?php 
							 echo str_replace(",", "", number_format((($total_ + ($prmat*$ex))/1.12)*0.12, 2)); ?>">
							</td>
						</tr>
						
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Total Amount:</td>
							<td style="width:50%; font-size: 18px; font-weight: bold;text-align: left;" id="total">
							    Php&nbsp;<input type="number" name="total" style="border:0px; width:50%;font-size: 15px;" id="tot" readonly value="<?php 
							 echo str_replace(",", "", number_format($total_ + ($prmat*$ex), 2)); ?>">
							</td>
						</tr>
						
						<?php
						//condition here
						if(isset($_SESSION["bookCode"])){
						
						    $rescode = $_SESSION["bookCode"];
						    $sqlcode = "SELECT * FROM reservation WHERE ResCode='$rescode'";
						    $rescodex = mysqli_query($conn, $sqlcode);
						    $rowcode = mysqli_fetch_array($rescodex);
						    $paid = $rowcode["DownpaymentPaid"];
						    $total_ -= $paid;
						    if($total_ < 0){
						        $total_ = 0;
						    }
						?>
						
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">Downpayment Paid:</td>
							<td style="width:50%; font-size: 18px;text-align: left;" id="total">Php <?php echo number_format($paid, 2); ?>
							    <input type="number" hidden id="totalz" value="<?php echo $paid; ?>">
							</td>
						</tr>
						
						
						<tr>
							<td style="width:50%; font-size: 18px;text-align: left;">New Balance:</td>
							<td style="width:50%; font-size: 18px; font-weight: bold;text-align: left;" id="total">
							    Php&nbsp;<input type="number" name="newbal" style="border:0px; width:50%" id="newbal" readonly value="<?php 
							 echo str_replace(",", "", number_format(($total_ + $prmat), 2)); ?>">
							</td>
						</tr>
						    
						<?php
						}
						else{
						?>
						
						<tr>
							<td style="width:30%; font-size: 18px;text-align: left;">Deadline of Downpayment: </td>
							
							<?php
								//get maxreserve days from settings
								    
									$settings = "SELECT * FROM settings WHERE SettingsID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								$NewDate=Date('F j, Y', strtotime("+$resday days"));
							?>
							
							<td style="width:70%; font-size: 18px; font-weight: bold;text-align: left;"><?php echo $NewDate; ?></td>
						</tr>
						
						
						<?php
						}
						?>
						
						
					</table>
					</div>
					</div>
					</div>
					</div>
				</center>	
				</div>
					<?php
					}
					?>
					
					
    <?php
    if(isset($_SESSION["bookCode"])){
    ?>
    <center>    
    <input type="checkbox" required> I have read and understood the terms and conditons
    <br><br><br>
    <input type="submit" value="Modify Booking" name="submitMod" id="form_button" />
    <input type="text"maxlength="50" name="total" hidden required value="<?php echo $total_; ?>">
    </center>
    <?php  
    }
    else{
    ?>
    

  
    <div class="name" style="margin-left:325px;">
      <label for="name">Name: &nbsp;&nbsp;</label>
      <input type="text" size="32"  placeholder="Name (e.g. Juan Dela Cruz)" maxlength="50" name="name" id="name_input" pattern=".+?(?:[\s'].+?){1,}" title="Name should contain atleast your first name and last name."  required>
    </div>
    <br>
    <div class="telephone" style="margin-left:700px;margin-top:-60px;">
      <label for="name">Contact Number:</label>
      <input type="text" size="26"  placeholder="Contact Number (e.g. 09XXXXXXXXX)" name="number" maxlength="11" pattern="[0-9]{11}" title="Follow the format: 09XXXXXXXXX." id="telephone_input"  required>
    </div>
    <br>
    <div class="email" style="margin-left:325px;">
      <label for="email">Email: &nbsp;&nbsp;</label>
      <input type="email" size="32" placeholder="Email Address" maxlength="50" name="email" id="email_input"  required>
    </div>
    <br>
    <div class="message" style="margin-left:325px;">
      <label for="message">Addres:</label>
      <textarea name="address" style="width:639px;"  size="32" placeholder="Address" id="message_input" maxlength="65535" cols="30" rows="5" required></textarea>
    </div>
    <br>
    <div class="submit" style="margin-left:380px;">
      <input class="awe-btn awe-btn-13" style="width:270px;" type="submit" value="Confirm Booking" name="submit" id="form_button" />
    </div>
    
    <?php
    }
    ?>
  </form><!-- // End form -->

   <?php
}
   ?>
   
<!-- // End #container -->
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
            
        </section>
        <!-- END / ABOUT -->

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
</body>
</html>