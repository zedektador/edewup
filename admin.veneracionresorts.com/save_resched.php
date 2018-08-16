<?php
	include("php_connect.php");
	   session_start();
	   
	                        $rescode = $_SESSION["bookCode"];
						    $sqlcode = "SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ResCode='$rescode'";
						    $rescodex = mysqli_query($conn, $sqlcode);
						    $rowcode = mysqli_fetch_array($rescodex);
						    
	   $resID = $rowcode["ReservationID"];
	   $email = $rowcode["EmailAddress"];
	   $del = "DELETE FROM room_reservation WHERE ReservationID=$resID";
	   $resdel = mysqli_query($conn, $del);
	   
	   //update reservation
	   date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$year = date("Y");
	$in = date_create($_SESSION["ed_in"]);
	$in_x = date_format($in, "d");
	$in_ = date_format($in, "Y-m-d");
	$out = date_create($_SESSION["ed_out"]);
	$out_ = date_format($out, "Y-m-d");
	$out_x = date_format($out, "d");
	
	
	$guest = $_SESSION["ed_guest"];
	$total = $_GET["total"];
	if(isset($_GET["mat"])){
	    
	$mat = $_GET["mat"];
	}
	else{
	    $mat = 0;
	}
	
	$perroom = $_SESSION["ed_numperroom"];
	
	$save = "UPDATE `reservation` SET `ReservationDate`='$today',`CheckinDate`='$in_',`CheckoutDate`='$out_',`Guests`=$guest,`RemainingBalance`=$total, Mattress=$mat WHERE `ResCode`='$rescode'";
	$res = mysqli_query($conn, $save);	
	if($res){
		$perroom = rtrim($perroom, ';');
		$arrayvar = explode(";",$perroom);
		foreach($arrayvar as $a){
			$break = explode(",", $a);
			$quantity = $break[0];
			$roomnum = $break[1];
			if($quantity != 0){
				//get room number from the roomtype given
				$getrm = "SELECT * FROM room WHERE RoomTypeID=$roomnum";
				$resnum = mysqli_query($conn, $getrm);
				$rownum = mysqli_fetch_array($resnum);
				$room = $rownum["RoomNumber"];
				for($i = 0; $i < $quantity; $i++){
					//query for insert here
					$ins = "INSERT INTO `room_reservation`(`RoomNumber`, `ReservationID`) VALUES ('$room',$resID)";
					$resins = mysqli_query($conn, $ins);
				}
			}
		}
	}
		
		
		//email the customer 
	   $message = "Please click the link to print your new Reservation Slip: www.veneracionresorts.com/front-assets/pages/email.php?id=$rescode";

	    mail($email,"New Reservation Slip",$message);

		header("location:reservation_list.php?message=Successfully edited reservation.");
?>