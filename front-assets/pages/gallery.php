<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>El Renzo Hotel | Gallery</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="icon" href="../img/favico.ico">
      <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

      <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
      </style> 

    <!-- HEADER AND NAVIGATION-->
      <link rel="stylesheet" type="text/css" href="../css/style.css"/>
      <link rel="stylesheet" href="../css/navstyle.css">

      <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
      <script src="../js/navstyle.js"></script>
    <!-- GALLERY LIGHTBOX -->
      <link rel="stylesheet" href="../css/gallery-lightbox.css">

        <script src="../js/gallery-lightbox.js"></script>




    <link rel="stylesheet" type="text/css" href="../css/footer.css"/>

</head>

<body>
    
<header>

  <img class="logo" src="../img/logo.png" width="70%" height="auto" style="max-width:230px; "/>
   

<div id='cssmenu'>
  <ul>
    <li><a href='../../index.php'>HOME</a></li>
    <li><a href='rooms-index.php'>ROOMS & RATES</a></li>
    <li><a href='#'>GALLERY</a></li>
    <li class='active'><a href='#'>RESERVATION</a>
      <ul>
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
         <li><a href='modify.php'>MODIFY RESERVATION</a></li>
         <li><a href='submitproof.php'>SUBMIT PROOF OF PAYMENT</a></li>
      </ul>
   </li>
    <li><a href='contact.php'>CONTACT US</a></li>
    
  </ul>
</div>
</header>

<div class="line-content">
  <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
    <span style="font-size: 40px; background-color: white; padding: 0 10px;">
     GALLERY
    </span>
  </div>
</div>

  <div id="wrapper">
    <ul id="portfolio" class="clearfix">
	<?php
	  include("php_connect.php");
	  $sql = "SELECT * FROM gallery";
	  $res = mysqli_query($conn, $sql);
	  $row = mysqli_fetch_array($res);
	  do{
		  if(mysqli_num_rows($res) != 0){
		?>
			<li><a href="<?php echo 'data:image/jpeg;base64,'.base64_encode( $row['Image'] ).''; ?>"><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $row['Image'] ).''; ?>"></a></li>
		<?php
		  }
	  }while($row = mysqli_fetch_array($res));
	  ?>
	</ul>
  </div>
  <footer>
   

    <div class="copyright">
        Copyright <i class="fa fa-copyright"></i>  2017 El Renzo Hotel - Tagaytay. All Rights Reserved
    </div>
</footer>
  
  
        <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>
</body>
</html>
