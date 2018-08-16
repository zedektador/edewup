<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>El Renzo Hotel | Rooms & Rates</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="icon" href="../img/favico.ico">
      <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>

    <!-- HEADER AND NAVIGATION-->
      <link rel="stylesheet" type="text/css" href="../css/style.css"/>
      <link rel="stylesheet" href="../css/navstyle.css">

      <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
      <script src="../js/navstyle.js"></script>
    <!-- GALLERY LIGHTBOX -->
      <link rel="stylesheet" href="../css/gallery-lightbox.css">

        <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>

        <script src="../js/gallery-lightbox.js"></script>

    <!-- ROOM THUMB -->
        <link rel="stylesheet" href="../css/roomstyle.css">

        <script src="../js/room.js"></script>

        <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

        <link rel='stylesheet prefetch' href='https://raw.githubusercontent.com/andiio/hosted/master/css/kalbreite.css'>

    <link rel="stylesheet" type="text/css" href="../css/footer.css"/>
      <!-- IDK HAHA -->
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js'></script>




</head>

<body>  
    
  <header>

      <img class="logo" src="../img/logo.png" width="70%" height="auto" style="max-width:230px; "/>
   

<div id='cssmenu'>

  <ul>
   <li><a href='../../index.php'>HOME</a></li>
   <li><a href='#'>ROOMS & RATES</a></li>
   <li><a href='gallery.php'>GALLERY</a></li>
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
         
         <li><a href='modify.php'>MODIFY RESERVATION</a>
         </li>
         <li><a href='submitproof.php'>SUBMIT PROOF OF PAYMENT</a>
         </li>
      </ul>
   </li>
   <li><a href='contact.php'>CONTACT US</a></li>
   
</ul>
</div>
    </header>

<div class="line-content">
  <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
    <span style="font-size: 40px; background-color: white; padding: 0 10px;">
     ROOMS & RATES
    </span>
  </div>
</div>
 




<div class="room-container">

<?php
include("php_connect.php");
$sql = "SELECT * FROM room_type";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
do{
	if(mysqli_num_rows($res) != 0){
?>

<!-- ############## STANDARD ################ -->
<div class="row">
  <section class="room">
   <!-- Room Image -->
    <div class="room_img">
      <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $row['RoomPic'] ).''; ?>" width="100%" height="auto" />
    </div>
        
    <!-- Room Information -->      
    <div class="room_information">
      <h2 class="room_information--heading"><?php echo $row["Description"]; ?></h2>
      <p><?php echo $row["AboutRoom"]; ?></p>
    </div>

    <div class="room_features">
     <ul class="info-icons">
        <li class="icons"><i class="fa fa-bed"></i>&nbsp;<?php echo $row["Beds"]; ?></li> <!-- Bath Icon -->
        <li class="icons"><i class="fa fa-male"></i>&nbsp;<?php echo $row["Capacity"]; ?></li> <!-- People Icon -->
        <li class="icons"><i class="fa fa-tv"></i>&nbsp;<?php echo $row["TV"]; ?></li> <!-- Price -->
    </ul> 
        <a href="javascript:void(0);" class="room_features--book-btn"><?php echo "P".number_format($row["Price"],2); ?> / NIGHT</a> <!-- P1,000 / NIGHT -->
    </div>  
  </section>
</div>  
<!-- /row-->

<?php
	}
}while($row = mysqli_fetch_array($res));
?>
</div><!-- /container -->
 

 
<footer>
    <div class="copyright">
        Copyright <i class="fa fa-copyright"></i>  2017 El REnzo Hotel - Tagaytay. All Rights Reserved
    </div>
</footer>


      
</body>

    

</body>
</html>
