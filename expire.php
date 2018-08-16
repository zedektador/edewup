<?php
	include("front-assets/pages/php_connect.php");
	$days = "SELECT * FROM settings WHERE SettingsID=1";
	$res = mysqli_query($conn, $days);
	$row = mysqli_fetch_array($res);
	$maxDays = $row["MaxReservationDays"] + 1;
	
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d"); //12
	
	
	//-> update reservation tble that you have already sent a message about expiration
	//message 1 day before expiration" 
	$expiring = "SELECT * FROM reservation WHERE (ReservationDate < DATE_SUB(NOW(), INTERVAL ($maxDays - 2) DAY) OR ExpDate = '$today') AND Status='PENDING' AND Notif='NO'";
	$resexp = mysqli_query($conn, $expiring);
	$rowexp = mysqli_fetch_array($resexp);
	if(mysqli_num_rows($resexp) != 0){
		do{
			$client = $rowexp["ClientID"];
			//get email from client id
			$em = "SELECT * FROM client WHERE ClientID=$client";
			$emres = mysqli_query($conn, $em);
			$emrow = mysqli_fetch_array($emres);
			$email = $emrow["EmailAddress"];
			
			$id = $rowexp["ReservationID"];
			$chkin = date_format(date_create($rowexp["CheckinDate"]), "F j, Y");
			$chkout = date_format(date_create($rowexp["CheckoutDate"]), "F j, Y");
			
			$message = "Good day valued guest! Your reservation for $chkin to $chkout is about to expire. Please deposit the downpayment immediately. Thank you!";
			
			mail($email,"Notice of Expiration",$message);

			
			//update notif to yes
			$upd = "UPDATE reservation SET Notif='YES' WHERE ReservationID=$id";
			$resupd = mysqli_query($conn, $upd);
			
		}while($rowexp = mysqli_fetch_array($resexp));
	}
	
	//notification on expiration
	$expired = "SELECT * FROM reservation WHERE (ReservationDate < DATE_SUB(NOW(), INTERVAL $maxDays DAY) OR DATE(DATE_ADD(ExpDate, INTERVAL +1 DAY)) = '$today') AND Status='PENDING'";
	$resexpd = mysqli_query($conn, $expired);
	$rowexpd = mysqli_fetch_array($resexpd);
	if(mysqli_num_rows($resexpd) != 0){
		do{
			$resid = $rowexpd["ReservationID"];
			$client_ = $rowexpd["ClientID"];
			//get email from client id
			$em = "SELECT * FROM client WHERE ClientID=$client_";
			$emres = mysqli_query($conn, $em);
			$emrow = mysqli_fetch_array($emres);
			$email = $emrow["EmailAddress"];
			
			$chkin_ = date_format(date_create($rowexpd["CheckinDate"]), "F j, Y");
			$chkout_ = date_format(date_create($rowexpd["CheckoutDate"]), "F j, Y");
			
			$message_ = "Good day valued guest! Your reservation for $chkin_ to $chkout_ already expired.";
			
			mail($email,"Notice of Expiration",$message_);
			

			//delete
			$del = "DELETE FROM reservation WHERE ReservationID=$resid";
			$resdel = mysqli_query($conn, $del);
			
		}while($rowexpd = mysqli_fetch_array($resexpd));
	}
?>