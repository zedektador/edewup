<?php
	include("php_connect.php");
	$days = "SELECT * FROM settings WHERE SettingsID=1";
	$res = mysqli_query($conn, $days);
	$row = mysqli_fetch_array($res);
	$maxDays = $row["MaxReservationDays"] + 1;
	
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d"); //12
	$time = date("H:i");
	
	//notification on expiration
	$expired = "SELECT * FROM reservation WHERE ReservationDate = '$today' AND DATE_SUB(ReservationTime, INTERVAL -1 HOUR) < '$time' AND Status='WAITING'";
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
			
			$message_ = "Good day valued guest! Your reservation for $chkin_ to $chkout_ is already deleted due to not confirming it.";
			
			mail($email,"Notice of Cancellation",$message_);


			//delete
			$del = "DELETE FROM reservation WHERE ReservationID=$resid";
			$resdel = mysqli_query($conn, $del);
			
		}while($rowexpd = mysqli_fetch_array($resexpd));
	}
?>