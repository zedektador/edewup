<?php
	include("php_connect.php");
	session_start();
	
	$perroom_ = $_POST["roomselected"];
	$rm = $_POST["rmnumber"];
	
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$temp = "";
								foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									if($quantity != 0){
										$temp .= $quantity.",".$roomnum.";"; 
									}
								}
								
								$temp_ = rtrim($temp, ";");
								$ar = explode(";", $temp_);
								// $rr = "";
								$mess = "";
								$ctr = 0;
								foreach($ar as $a){
									$br = explode(",", $a);
									$q = $br[0];
									$rtid = $br[1];
									foreach($rm as $b){
										//get rtid per room number
										$getid = "SELECT * FROM room WHERE RoomNumber='$b'";
										$resid = mysqli_query($conn, $getid);
										$rowid = mysqli_fetch_array($resid);
										$rid = $rowid["RoomTypeID"];
										if($rid == $rtid){
											$q -= 1;
										}
									}
									$mess .= $q."";
									$ctr++;
								}
								
								$hey = "";
								for($i = 0; $i < $ctr; $i++){
									$hey .= "0";
								}
	if($mess != $hey){
		header("location:walk_checkin.php?mess=The rooms you selected do not match the actual number of rooms.");
	}
	else{
		
		$out = $_SESSION["a_out"];
		$client = $_SESSION["a_name"];
		$guest = $_SESSION["a_guest"];
		$rmselected = $_POST["roomselected"];
		date_default_timezone_set("Asia/Manila");
		$today = date("Y-m-d");
	
	    if(isset($_SESSION["resid"])){
	            $in_id = $_SESSION["resid"];
	        	//update reservation
        		$updres = "UPDATE reservation SET Status='CONFIRMED' WHERE ReservationID=$in_id";
        		$resupdres = mysqli_query($conn, $updres);
        		
        		$chkin = "INSERT INTO `checkin`(`ReservationID`, `CheckinDateTime`) VALUES ($in_id, '$today')";
        		$reschk = mysqli_query($conn, $chkin);
        		unset($_SESSION["resid"]);
	    }
	    else{
	        $walk = "INSERT INTO `walkin`(`ClientName`, `Guests`) VALUES ('$client',$guest)";
		    $reswalk = mysqli_query($conn, $walk);
		
    		//get walkinid
    		$getwalk = "SELECT * FROM walkin ORDER BY WalkinID DESC";
    		$resgetwalk = mysqli_query($conn, $getwalk);
    		$rowwalk = mysqli_fetch_array($resgetwalk);
    		$walkinid = $rowwalk["WalkinID"];
    		
    		$chkin = "INSERT INTO `checkin`(`WalkinID`, `CheckinDateTime`, `CheckoutDateTime`) VALUES ($walkinid, '$today', '$out')";
    		$reschk = mysqli_query($conn, $chkin);    
	    }
	    
		
		
		//get check in id
		$getchk = "SELECT * FROM checkin ORDER BY CheckinID DESC";
		$resgetchk = mysqli_query($conn, $getchk);
		$rowchk = mysqli_fetch_array($resgetchk);
		$chkinid = $rowchk["CheckinID"];
		
							foreach($rm as $b){
								$rm = "UPDATE room SET Status='IN-USE', CheckinID=$chkinid WHERE RoomNumber='$b'";
								$rmres = mysqli_query($conn, $rm);
							}
	
	$_SESSION["step"] = "5";
	header("location:walk_checkin.php?mess=Guest successfully checked-in!");
	//echo $rmselected;
	}
	
	
?>