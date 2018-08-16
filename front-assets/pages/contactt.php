<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    
    <!-- TITLE -->
    <title>Contact</title>

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
                    <!-- HEADER MENU -->
                    <nav class="header_menu">
                        <ul class="menu">
                            <li>
                                <a href="../../index.php">Home</a>
                            </li>
                            <li>
                                <a href="about.php">About</a>
                            </li>
                            <li>
                                <a href="#">Room
                                    <span class="fa fa-caret-down"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="rooms.php">Rooms & Cottages</a>
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
                            <li class="current-menu-item">
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
            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>CONTACT WITH US</h2>
                    </div>
                </div>

            </div>

        </section>
        <!-- END / SUB BANNER -->

        <!-- CONTACT -->
        <section class="section-contact">
            <div class="container">
                <div class="contact">
                    <div class="row">

                        <div class="col-md-6 col-lg-5">
                            <?php
				include("php_connect.php");
				$set = "SELECT * FROM settings WHERE SettingsID=1";
				$resset = mysqli_query($conn, $set);
				$rowset = mysqli_fetch_array($resset);
				?>
				

                            <div class="text">
                                <h2>Contact</h2>
                                <ul>
                                    <li><i class="icon lotus-icon-location"></i> Alfonso - Indang Road, Indang, Cavite</li>
                                    <li><i class="icon lotus-icon-phone"></i><?php echo $rowset["ContactNumber"]; ?></li>
                                    <li><i class="icon lotus-icon-envelope"></i><?php echo $rowset["EmailAddress"]; ?></li>
                                </ul>
                            </div>

                        

                        </div>

                        <div class="col-md-6 col-lg-6 col-lg-offset-1">
                            <div id="contact-container">
  <!--<h1>&bull; Keep in Touch &bull;</h1>
  <div class="underline"> 
  </div> -->
 
  <div class="icon_wrapper">
    

	<?php
	if(isset($_GET["success"])){
	?>
		<script>
			swal("Success", "Message successfully delivered", "success");
			history.pushState(null, '', '/EL%20RENZO%203/EL%20RENZO/front-assets/pages/contact.php');
		</script>
	<?php
	}
	?>
	


  </div>

  <form action="sendemail.php" method="post" id="contact_form">
    <div class="contact-form">
      
      <input type="text" class="field-text" placeholder="name" maxlength="50" name="name" id="name_input" required>
    </div>
    <div class="contact-form">
     
      <input type="number" class="field-text" placeholder="Contact number (e.g. 09XXXXXXXXX)" name="telephone" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="telephone_input" required>
    </div>
    <div class="contact-form">
      
      <input type="email" class="field-text" placeholder="Email Address" maxlength="50" name="email" id="email_input" required>
    </div>
    
    <div class="contact-form">
      
      <input type="text" class="field-text" placeholder="Subject" name="subject" maxlength="100" id="subject_input" required>
    </div>
    <div class="contact-form">
     
      <textarea name="message" class="field-text" placeholder="Message" id="message_input" maxlength="65535" cols="30" rows="5" required></textarea>
    </div>
    <div class="contact-form">
      <input type="submit" class="awe-btn awe-btn-13" value="Send Message" name="submit" id="form_button" />
    </div>
  </form><!-- // End form -->

   
</div><!-- // End #container -->
                        </div>

                    </div>  
                </div>
            </div>
        </section>
        <!-- END / CONTACT -->

        <!-- MAP -->
        <section class="section-map">
            <h1 class="element-invisible">Map</h1>
            <div class="contact-map">
                <div id="map" data-locations="14.189639,120.868473" data-center="14.189639,120.868473"></div>
            </div>
        </section>
        <!-- END / MAP -->
        
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
    <!-- validate -->
    <script type="text/javascript" src="VeneracionDesign/js/lib/jquery.form.min.js"></script>
    <script type="text/javascript" src="VeneracionDesign/js/lib/jquery.validate.min.js"></script>
    <!-- Custom jQuery -->
    <script type="text/javascript" src="VeneracionDesign/js/scripts.js"></script>
</body>
</html>