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
                                        <a href="#">Modify Reservation</a>
                                    </li>
                                    <li>
                                        <a href="#">Submit Proof of Payment</a>
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
if(isset($_GET["id"])){
    include("php_connect.php");
    
    $id = $_GET["id"];
    $sql = "UPDATE `reservation` SET `Status`='PENDING' WHERE ResCode='$id'";
    $res = mysqli_query($conn, $sql);
    ?>
    
    	<div style="width: 70%; margin: auto; margin-top:150px; margin-bottom:150px">
    	    	<center><h3 style=" color: #474544;
  font-size: 20px;
  font-weight: 600;
  text-align: center;
  text-transform: uppercase;">Reservation successfully confirmed!</h3></center><br>
    	    	<center><h5>Please check your email for the Reservation Slip.</h5> <h5>Thank you for patronizing Montalban Waterpark and Garden Resort.</h5></center>
    	</div>

<?php
//send email that will redirect to the printing page of the reservation slip  
$em = "SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ResCode='$id'";
$emres = mysqli_query($conn, $em);
$emrow = mysqli_fetch_array($emres);
$email = $emrow["EmailAddress"];

$message = "Please click the link to print your Reservation Slip: www.veneracionresorts.com/front-assets/pages/email.php?id=$id";

mail($email, "Reservation Slip", $message);
}
?>
   
</div><!-- // End #container -->

   
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