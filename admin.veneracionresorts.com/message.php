<?php
	//notification: Date: Xxx xx, xx (INSERT MESSAGE HERE)/
	include("php_connect.php");
if(isset($_POST["msgx"])){
    
	$message = $_POST["msg"];
	$mid = $_POST["lbcid"];
	
	//get clientID base on lbcid
$get = "SELECT * FROM messages WHERE MessageID=$mid";
$resget = mysqli_query($conn, $get);
$rowget = mysqli_fetch_array($resget);
$email = $rowget["EmailAddress"];

// send email
mail($email,"El Renzo Hotel Response",$message);

$upd = "UPDATE messages SET Replied='YES' WHERE MessageID=$mid";
$resupd = mysqli_query($conn, $upd);

header("location:messages.php?message=Message successfully sent.");
}
else{
    date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	
	$message = $_POST["msg"];
	$lbcid = $_POST["lbcid"];
	
	//get clientID base on lbcid
$get = "SELECT * FROM uploaded_slip JOIN reservation ON reservation.ReservationID=uploaded_slip.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE SlipID=$lbcid";
$resget = mysqli_query($conn, $get);
$rowget = mysqli_fetch_array($resget);
$email = $rowget["EmailAddress"];

// send email
mail($email,"Bank Slip Verification",$message);

$upd = "UPDATE uploaded_slip SET Status='REJECTED' WHERE SlipID=$lbcid";
$resupd = mysqli_query($conn, $upd);

header("location:bankpayments.php?message=Message successfully sent.");
}
?>