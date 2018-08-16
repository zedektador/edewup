<?php
	if(isset($_POST["submit"])){
	include("php_connect.php");
	session_start();
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$todaytime = date("H:i");
	$year = date("Y");
	$in = date_create($_SESSION["indate"]);
	$in_x = date_format($in, "d");
	$in_ = date_format($in, "Y-m-d");
	$out = date_create($_SESSION["outdate"]);
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
	
	$guest = $_SESSION["guest"];
	$total = $_POST["total"];
	
	
	if(isset($_POST["mat"])){
	    $mat = $_POST["mat"];
	}
	else{
	    $mat = 0;
	}
	
	//insert to client tbl first
	$clname = $_POST["name"];
	$clemail = $_POST["email"];
	$claddress = $_POST["address"];
	$clnumber = $_POST["number"];
	
	
	echo $clname.';'.$clemail.';'.$claddress.';'.$clnumber.';';
	
	
	$insclient = "INSERT INTO `client`(`Name`, `EmailAddress`, `Address`, `ContactNumber`, `Status`, `Deleted`) VALUES ('$clname', '$clemail', '$claddress', '$clnumber', 'Active', 'No')";
	$rescl = mysqli_query($conn, $insclient);
	
	//get last clientID
	
	$selcl = "SELECT * FROM client ORDER BY ClientID DESC";
	$rescl = mysqli_query($conn, $selcl);
	$rowcl = mysqli_fetch_array($rescl);
	
	$client = $rowcl["ClientID"];
	
	 //get maxreserve days from settings
									$settings = "SELECT * FROM settings WHERE SettingsID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								
							$expdate = date("Y-m-d", strtotime("$today +$resday days" ));
	
	$perroom = $_SESSION["numperroom"];
	$save = "INSERT INTO `reservation`(ResCode, `ReservationDate`, `CheckinDate`, `CheckoutDate`, `Guests`, `ClientID`, `TotalBill`, `Status`, `ExpDate`, `Mattress`, `ReservationTime`) VALUES ('$rescode', '$today','$in_','$out_',$guest,'$client',$total,'WAITING', '$expdate', $mat, '$todaytime')";
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
	unset($_SESSION["indate"]);
	
	//email the customer
	
// the message
$msg = "Please click the link to confirm reservation: http://veneracionresorts.com/front-assets/pages/confirm_res.php?id=$rescode";

// send email
mail($clemail,"Confirm Reservation",$msg);

	header("location:confirm.php?success_");
	
	}
	else{
	    include("php_connect.php");
	   session_start();
	   
	                        $rescode = $_SESSION["bookCode"];
						    $sqlcode = "SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ResCode='$rescode'";
						    $rescodex = mysqli_query($conn, $sqlcode);
						    $rowcode = mysqli_fetch_array($rescodex);
						    
	   $resID = $rowcode["ReservationID"];
	   
	   $del = "DELETE FROM room_reservation WHERE ReservationID=$resID";
	   $resdel = mysqli_query($conn, $del);
	   
	   //update reservation
	   date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$year = date("Y");
	$in = date_create($_SESSION["indate"]);
	$in_x = date_format($in, "d");
	$in_ = date_format($in, "Y-m-d");
	$out = date_create($_SESSION["outdate"]);
	$out_ = date_format($out, "Y-m-d");
	$out_x = date_format($out, "d");
	
	$guest = $_SESSION["guest"];
	$total = $_POST["newbal"];
	$perroom = $_SESSION["numperroom"];
	
	if(isset($_POST["mat"])){
	    $mat = $_POST["mat"];
	}
	else{
	    $mat = 0;
	}
	
	$save = "UPDATE `reservation` SET `ReservationDate`='$today',`CheckinDate`='$in_',`CheckoutDate`='$out_',`Guests`=$guest,`RemainingBalance`=$total, `Mattress`=$mat WHERE `ResCode`='$rescode'";
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
    $message = "Please click the link to print your updated Reservation Slip: www.veneracionresorts.com/front-assets/pages/email.php?id=$rescode";

$email = $rowcode["EmailAddress"];
    
mail($email, "Reservation Slip", $message);


    unset($_SESSION["indate"]);
	unset($_SESSION["bookCode"]);
	
	header("location:confirm.php?successx");
	    
	}
?>
