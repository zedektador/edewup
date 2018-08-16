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
	$expiring = "SELECT * FROM reservation WHERE CheckoutDate='$today' AND Status='PAID' AND Notif='NO'";
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
			
			$message = "Good day valued guest! Your reservation for $chkin to $chkout is about to be deleted since you did not come on the date specified.";
			
			mail($email,"Notice of Cancellation",$message);

			//update notif to yes
			$upd = "UPDATE reservation SET Notif='YES' WHERE ReservationID=$id";
			$resupd = mysqli_query($conn, $upd);
			
		}while($rowexp = mysqli_fetch_array($resexp));
	}
	
	//notification on expiration
	$expired = "SELECT * FROM reservation WHERE CheckoutDate < '$today' AND Status='PAID'";
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
			
			$message_ = "Good day valued guest! Your reservation for $chkin_ to $chkout_ is already deleted due to absence on reserved dates. Sad to say, there is a strict policy of no refund. Thank you!";
			
			mail($email,"Notice of Cancellation",$message_);

			//delete
			$del = "DELETE FROM reservation WHERE ReservationID=$resid";
			$resdel = mysqli_query($conn, $del);
			
		}while($rowexpd = mysqli_fetch_array($resexpd));
	}
?>