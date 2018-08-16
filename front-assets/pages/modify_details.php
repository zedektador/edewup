<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>Modify Resevation</title>

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
                        <?php
          //Copy this block of code IZA:
          session_start();
          if(isset($_SESSION["res_in"])){
          ?>
          
          
         <li><a href='reserve.php'>BOOK YOUR STAY</a>
         </li>
         
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
                        <h2>Modify Resevation</h2>
                    </div>
                </div>

            </div>

        <!-- END / SUB BANNER -->

        <!-- TERM CONDITION -->
        <section class="section-term-condition bg-white">
            <div class="container">
                <?php
	if(isset($_GET["message"])){
	?>
		<script>
			swal("Error", "Booking code doesn't exist or payment is not yet settled.", "error");
			history.pushState(null, '', '/front-assets/pages/modify.php');
		</script>
	<?php
	}
	?>
<div class="container">
                <div class="term-condition">
                    
  
<?php
	if(isset($_GET["message"])){
	?>
		<script>
			swal("Error", "Booking code doesn't exist or payment is not yet settled.", "error");
			history.pushState(null, '', '/front-assets/pages/modify.php');
		</script>
	<?php
	}
	
	    
        if(isset($_SESSION["bookCode"])){
	 	    
	 	    include("php_connect.php");
	 	    //query in out guest from bookCode
	 	    $code = $_SESSION["bookCode"];
	 	    $sqlcode = "SELECT * FROM reservation WHERE ResCode='$code'";
	 	    $rescode = mysqli_query($conn, $sqlcode);
	 	    $rowcode = mysqli_fetch_array($rescode);
	 	    $incode = $rowcode["CheckinDate"];
	 	    $outcode = $rowcode["CheckoutDate"];
	 	    $guestcode = $rowcode["Guests"];
	 	    
	 	    ?>       
	 	     
	 	 	<script>
			swal("Reservation", "You can now modify your booking.", "success");
		</script>
		
		<form action="reserve_sess.php" method="post">
		    
		    
		    <div class="col-lg-12" style="height:300px">
				<center><table style="width:70%">
				<tr>
				<td></td>				
				<td style="width:60%"><h2 style="font-size: 20px;margin-left:150px">Check-in Date: </h2></td>
				<td><h2 style="font-size: 20px; font-weight:normal;margin-right:150px;margin-top:5px;">  <input class="awe-calendar from"  type="text" name="in" value="<?php echo $incode; ?>" onchange="updDate()"  required/></h2></td>	
				</tr>				
				<tr>
				<td></td>
				<td><h2 style="font-size: 20px;margin-left:150px">Check-out Date: </h2></td>
				<td><h2 style="font-size: 20px; font-weight:normal;margin-right:150px;margin-top:5px;">  <input class="awe-calendar to" type="text" name="out" value="<?php echo $outcode; ?>" required/></h2></td>	
				</tr>
				<tr>
				<td></td>
				    <?php
			    
			    //get max from DB
			    $sqlset = "SELECT `MaxGuest` FROM `settings` WHERE SettingsID=1";
			    $resset = mysqli_query($conn, $sqlset);
			    $rowset = mysqli_fetch_array($resset);
			    ?>
				<td><h2 style="font-size: 20px;margin-left:150px">Guest: </h2></td>
				<td><h2 style="font-size: 20px; font-weight:normal;margin-right:150px;margin-top:5px;"> <input  type="number" <input class="form-control" name="guest" min="1" max="<?php echo $rowset["MaxGuest"]; ?>"  value="<?php echo $guestcode; ?>" required></h2></td>	
				</tr>
				</table><br>
				<button class="awe-btn awe-btn-6"  type="submit">SEARCH</button>
				</center>
					</div>
		    
		    
         
         
         </form>
			<!-- <div class="kids">
            <input  type="number"  value="0" name="Kids" min="0" max="6">       
			</div>-->
<!--<div class="book">-->
	 	     
	 	    <?php
	 	    }
	 	    ?>
	 	    
 

   
</div>
 

   
</div><!-- // End #container -->

<div id="msa-popup1" class="msa-overlay">  
    <div class="msa-popup">
        
        
        
    </div>
</div>
            </div>
        <br/>
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