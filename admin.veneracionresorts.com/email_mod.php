<?php 
   include("php_connect.php");
   
   $rescode = $_SESSION["bookCode"];    
     $sql = "SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ResCode='$rescode'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    

  require 'php_connect.php';
  require 'fpdf181/fpdf.php';

  $code = $rescode;
  $name = $row["Name"];
  $add = $row["Address"];
  $email = $row["EmailAddress"];
  $contact = $row["ContactNumber"];
  $bookingDate = $row["ReservationDate"];
  $checkin = $row["CheckinDate"];
  $checkout = $row["CheckoutDate"];
  $resID = $row["ReservationID"];
  $total = $row["RemainingBalance"];
  
  $pdf = new FPDF();

  $pdf -> AddPage();
  $pdf -> SetFont("helvetica", "", "14");
  $pdf -> Cell(0, 10, "Reservation Form", 0, 1, "C");
  $pdf -> Line(10, 20, 200, 20);
  $pdf -> Image('../img/ELrenzo-circle.png', 90, 20, 30, 20);
  $pdf -> SetFont("helvetica", "B", "12");
  $pdf -> Cell(0, 50, "EL RENZO HOTEL", 0, 1, "C");
  $pdf -> SetFont("helvetica", "", "12");
  $pdf -> Cell(0, -40, "Purok IV Barangay Sicat, Alfonso Cavite, Tagaytay, Cavite", 0, 1, "C");
  $pdf -> Line(10, 55, 200, 55);
  $pdf -> SetFont("helvetica", "B", "12");
  $pdf -> SetTextColor(255, 0, 0);
  
  $pdf -> SetFont("helvetica", "B", "12");
  $pdf -> SetTextColor(0, 0, 0);
  $pdf -> Cell(0, -60, "Reservation Code: {$code}", 0, 1);
  
  $pdf -> SetFont("helvetica", "", "8");
  $pdf -> SetTextColor(0, 0, 0);
  $pdf -> Cell(0, 70, "(This code will be used for rebooking and for uploading bank slip.)", 0, 1);
  
  $pdf -> SetFont("helvetica", "U", "12");
  $pdf -> SetTextColor(0, 0, 0);
  $pdf -> Cell(0, -50, "Guest Information", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(0, 60, "Name: {$name}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(0, -50, "Address: {$add}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(0, 60, "Email: {$email}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(0, -50, "Contact Number: {$contact}", 0, 0);
  $pdf -> SetFont("helvetica", "U", "12");
  
  $pdf -> Cell(-50, -90, "Reservation Details", 0, 1, "R");
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(101.35);
  $pdf -> Cell(0, 100, "Booking Date: {$bookingDate}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(101.35);
  $pdf -> Cell(-50, -90, "Check-In Date: {$checkin}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(101.35);
  $pdf -> Cell(0, 100, "Check-Out Date: {$checkout}", 0, 0);
  
  $pdf -> SetFont("helvetica", "U", "12");
  $pdf -> Cell(-62, 120, "Room Details", 0, 1, "R");
  
  //loop for the rooms
  $resloop = "SELECT *, COUNT(*) as quan FROM room_reservation JOIN room ON room_reservation.RoomNumber=room.RoomNumber JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE ReservationID=$resID GROUP BY Description";
  $resres = mysqli_query($conn, $resloop);
  $rowresx = mysqli_fetch_array($resres);
  
  do{

    $roomname = $rowresx["Description"];
    $roomrate = $rowresx["Price"];
    $roomcapacity = $rowresx["Capacity"];
    $quan = $rowresx["quan"];
      
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(100.50);
  $pdf -> Cell(0, -110, "Room Name: {$roomname}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(100.50);
  $pdf -> Cell(-62, 120, "Room Rate: {$roomrate}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(100.50);
  $pdf -> Cell(0, -110, "Room Capacity: {$roomcapacity}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(100.50);
  $pdf -> Cell(-62, 120, "Quantity: {$quan}", 0, 1);
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(100.50);
  $pdf -> Cell(0, -110, "", 0, 1);
  
  }while($rowresx = mysqli_fetch_array($resres));
  
  $pdf -> SetFont("helvetica", "B", "10");
  $pdf -> Cell(100.50);
  $pdf -> Cell(-62, 110, "Remaining Balance: {$total}", 0, 1);
  
  
  $stin = date_format(date_create($rowset["StandardIn"]), "H:i a");
  $stout = date_format(date_create($rowset["StandardOut"]), "H:i a");
  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-6.0.2/PHPMailer/src/PHPMailer.php';
require 'PHPMailer-6.0.2/PHPMailer/src/SMTP.php';
require 'PHPMailer-6.0.2/PHPMailer/src/Exception.php';

  $mail = new PHPMailer();
  //$mail->isSMTP();
  $mail->Host = ' mx1.hostinger.ph';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Username = "elrenzohotel.com";
  $mail->Password = "elrenzo";
  $mail->setFrom('elrenzo@elrenzohotel.com', 'El Renzo Hotel');
  $mail->addReplyTo('elrenzo@elrenzohotel.com', 'El Renzo Hotel');
  $mail->addAddress($email);
  $mail->addCC($email);
  $mail->addBCC($email);
  $mail->Subject = 'Reservation Form';
  $mail->Body = 'Good day! This is your updated Reservation Form';
  
  $mail->isHTML(true);  
  
  $mail->addStringAttachment($pdf->Output("S",'reservationform.pdf'), 'reservationform.pdf', $encoding = 'base64', $type = 'application/pdf');
  
  
  if(!$mail->send()) {
    echo "mailer Error: ". $mail->ErrorInfo;
  }
?>