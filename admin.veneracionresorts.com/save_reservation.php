<?php
	if(isset($_GET["total"])){
	include("php_connect.php");
	session_start();
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$year = date("Y");
	$in = date_create($_SESSION["wi_in"]);
	$in_x = date_format($in, "d");
	$in_ = date_format($in, "Y-m-d");
	$out = date_create($_SESSION["wi_out"]);
	$out_ = date_format($out, "Y-m-d");
	$out_x = date_format($out, "d");
	
	do {
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
		//for reservation code (year.in.out.random(5)
		$rescode = $year.$in_x.$out_x.$randomString;
		
	$chkcode = "SELECT * FROM reservation WHERE ResCode='$rescode'";
	$reschkcode = mysqli_query($conn, $chkcode);
	$numcode = mysqli_num_rows($reschkcode);
	
	}while($numcode != 0);
	
	$guest = $_SESSION["wi_guest"];
	$total = str_replace(",","",$_GET["total"]);
	$clientID = $_SESSION["wi_clid"];
	$perroom = $_SESSION["wi_numperroom"];
	
	    	$settings = "SELECT * FROM settings WHERE SettingsID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								
							$expdate = date("Y-m-d", strtotime("$today +$resday days" ));
							
	if(isset($_GET["mat"])){
	    $mat = $_GET["mat"];
	}
	else{
	    $mat = 0;
	}
							
	$save = "INSERT INTO `reservation`(ResCode, `ReservationDate`, `CheckinDate`, `CheckoutDate`, `Guests`, `ClientID`, `TotalBill`, `Status`, `ExpDate`, `Mattress`) VALUES ('$rescode', '$today','$in_','$out_',$guest,$clientID,$total,'PENDING', '$expdate', $mat)";
	$res = mysqli_query($conn, $save);	
	if($res){
		//per room
			//get reservation id
		$get = "SELECT * FROM reservation ORDER BY ReservationID DESC";
		$resget = mysqli_query($conn, $get);
		$rowget = mysqli_fetch_array($resget);
		$resid = $rowget["ReservationID"];
		
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
					$ins = "INSERT INTO `room_reservation`(`RoomNumber`, `ReservationID`) VALUES ('$room',$resid)";
					$resins = mysqli_query($conn, $ins);
				}
			}
		}
	}
	unset($_SESSION["wi_step"]);
	
	//email the customer
	
// the message
$msg = "Please click the link to print your Reservation Slip: www.veneracionresorts.com/front-assets/pages/email.php?id=$rescode";

// send email
mail($_SESSION["email"],"Reservation Slip",$msg);

	header("location:reservation.php?mess=Reservation slip successfully sent to your email.");
	}
?>