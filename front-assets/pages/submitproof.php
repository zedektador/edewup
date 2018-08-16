<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>Proof of Payment</title>

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
                            <li>
                                <a href="../../index.php">Home</a>
                            </li>
                            <li>
                                <a href="about.php">About</a>
                            </li>
                            <li >
                                <a href="#">Room
                                    <span class="fa fa-caret-down"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="rooms.php">Rooms & Cottages</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <li class="current-menu-item">
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
        <section class="section-sub-banner bg-22">
            <div class="awe-overlay"></div>
            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>Proof of Payment</h2>
                    </div>
                </div>

            </div>

        <!-- END / SUB BANNER -->

        
        <section class="section-term-condition bg-white">
            <div class="container">               
                
                <div class="term-condition">
                    
		<?php
	if(isset($_GET["message"])){
	?>
		<script>
			swal("Success", "Slip successfully sent.", "success");
			history.pushState(null, '', '/front-assets/pages/submitproof.php');
		</script>
	<?php
	}
	elseif(isset($_GET["messagex"])){
	?>
		<script>
			swal("Error", "Booking code doesn't exist.", "error");
			history.pushState(null, '', '/front-assets/pages/submitproof.php');
		</script>
	<?php
	}
	elseif(isset($_GET["message_"])){
	?>
		<script>
			swal("Warning", "Please resend the image.", "warning");
			history.pushState(null, '', '/front-assets/pages/submitproof.php');
		</script>
	<?php
	}
	?>

<center>
 <h3 class="text-uppercase">Please upload here: </h3>
  </div>

  <form action="checkcode.php" style="margin-left:450px;" method="post" id="contact_form"  enctype="multipart/form-data">
      <div class='row'>
      <div class='col-md-4'>
      <p>Booking Code:  </p>
      <input type="text" class="form-control" placeholder="Booking Code" name="bookingcode" maxlength="20" id="name_input" required>
      </div>
      </div>
      <br>
      <div class='row'>
      <div class='col-md-4'>
      <p>Deposit Slip:  </p>
      <input type="file" class="form-control"  accept="image/*" name="fileToUpload" id="fileToUpload" required>
      </div>
      </div>
      <br>
    <div class="submit">
      <input type="submit" class="awe-btn awe-btn-6" name="submitSlip" value="Submit" id="form_button" />
    </div>
  </form>
<div id="msa-popup1" class="msa-overlay">  
    <div class="msa-popup">
        <h2>Terms and Condition</h2>
        
        <div class="msa-content">
            <ol>
	<li>Fifty percent (50%) deposit is required upon reservation. This is NON-REFUNDABLE. The remaining fifty percent (50%) should be paid upon check in on the day of your reservation. </li>
	<li>If the payment is not made within 3 days, the reservation will automatically loss.</li>
	
	
	<li>When a guest wishes to registered prolong his departure date, prior notice should be given to the Front Desk. If an extension of stay is possible, settlement of past due accounts shall be required.</li>

</ol>

        </div>
    </div>
</div>
   



		</div>
            </div>
        
        </section>
        
        <!-- END / ABOUT -->

        <!-- FOOTER -->
        <footer id="footer">

            <!-- FOOTER BOTTOM -->
            <div class="footer_bottom">
                <div class="container">
                    <p>&copy; 2017 Villa Filomena Natural Spring Resort All rights reserved.</p>
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