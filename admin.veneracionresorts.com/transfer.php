<?php
	include("php_connect.php");
	//get rm price
	if(isset($_POST["rmdet"])){
		//display details
		$rmnum = $_POST["rmnum"];
			//get details
			$det = "SELECT * FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE RoomNumber='$rmnum'";
			$resdet = mysqli_query($conn, $det);
			$rowdet = mysqli_fetch_array($resdet);
			$price = $rowdet["Price"];
			$cap = $rowdet["Capacity"];
			$additional = $rowdet["AdditionalPerHead"];
			if($additional == null){
				$additional = "FREE";
			}
			$about = $rowdet["AboutRoom"];
			echo "
			<center>
			<table style='width: 70%; font-size:15px'>
				<tr>
					<td colspan=2><b><center>Room Details</center></b></td>
				</tr>
				<tr>
					<td colspan='2'><center>&nbsp;</center></td>
				</tr>
				<tr>
					<td><b>Price:</b></td>
					<td>$price</td>
				</tr>
				<tr>
					<td><b>Capacity:</b></td>
					<td>$cap</td>
				</tr>
				<tr>
					<td colspan='2'><center>&nbsp;</center></td>
				</tr>
				<tr>
					<td colspan='2'><center>$about</center></td>
				</tr>
			</table>
			</center>
			";
	}
	elseif(isset($_POST["trans"])){
		//insert to trans tbl
		$prevRoom = $_POST["resid"];
		$newRoom = $_POST["rmtrans"];
		
		//get prevRoom
		$prev = "SELECT * FROM room WHERE RoomNumber='$prevRoom'";
		$resprev = mysqli_query($conn, $prev);
		$rowprev = mysqli_fetch_array($resprev);
		$chkID = $rowprev["CheckinID"];
		
		
		date_default_timezone_set("Asia/Manila");
		$today = date("Y-m-d H:i:s");
		
		$trans = "INSERT INTO `room_transfer`(`TransferDateTime`, `PreviousRoom`, `NewRoom`, `CheckinID`) VALUES ('$today','$prevRoom', '$newRoom', $chkID)";
		$restrans = mysqli_query($conn, $trans);
		
		//Update prev room
		$updprev = "UPDATE room SET Status='AVAILABLE', CheckinID=NULL WHERE RoomNumber='$prevRoom'";
		$resprev = mysqli_query($conn, $updprev);
		
		//Update new room
		$updnew = "UPDATE room SET Status='IN-USE', CheckinID=$chkID WHERE RoomNumber='$newRoom'";
		$resnew = mysqli_query($conn, $updnew);
		header("location:directory.php?message=Successfully updated records.");
			
	}
	else{
	$rm = $_POST["rmnumber"];
	$get = "SELECT * FROM room JOIN room_type ON room_type.RoomTypeID=room.RoomTypeID JOIN checkin ON checkin.CheckinID=room.CheckinID WHERE RoomNumber='$rm'";
	$res = mysqli_query($conn, $get);
	$row = mysqli_fetch_array($res);
	$price = $row["Price"];
	$expOut = date_format(date_create($row["CheckoutDateTime"]), "Y-m-d");
	$inxxx = $row['CheckinID'];
	    
	//check kung ung checkinID na un ay may record na sa room transfer
	    $chk = "SELECT * FROM room_transfer WHERE CheckinID=$inxxx AND NewRoom='$rm'";
	    $reschk = mysqli_query($conn, $chk);
	    if(mysqli_num_rows($reschk) != 0){ //meron na
	        echo "meron";     
	    }
	else{
	
	echo "<select class='form-control' id='rmavail' style='width:70%' name='rmtrans' onchange='chgdet()'>";
	
	//get all cnt of rooms 
	$sqlroom = "SELECT *, COUNT(*) as cntroom, room_type.RoomTypeID as rmID FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID GROUP BY room_type.RoomTypeID";
	$resroom = mysqli_query($conn, $sqlroom);
	$rowroom = mysqli_fetch_array($resroom);

	
	if(mysqli_num_rows($resroom) != 0){
		do{
	//get from reservations
	$sqlres = "SELECT *, COUNT(*) AS count FROM reservation JOIN room_reservation ON reservation.ReservationID=room_reservation.ReservationID JOIN room ON room_reservation.RoomNumber=room.RoomNumber JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE (reservation.CheckoutDate < '$expOut') AND reservation.Status IN ('PENDING', 'PAID') GROUP BY Description";
	//above code is for getting reservations with conflict to out date
	
	$sqlchk = "SELECT *, COUNT(*) as countchkin FROM room LEFT JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room.Status='IN-USE' GROUP BY room_type.Description";
	//above code is for getting the number of rooms in use
	
	$res = mysqli_query($conn, $sqlres);
	$row = mysqli_fetch_array($res);
					
	$resx = mysqli_query($conn, $sqlchk);
	$rowx = mysqli_fetch_array($resx);
							$cnt = $rowroom["cntroom"];
							if(mysqli_num_rows($res) != 0){
								do{
									if($rowroom["Description"] == $row["Description"]){
										$cnt -= $row["count"];
									}
								}while($row = mysqli_fetch_array($res));
							}
							if(mysqli_num_rows($resx) != 0){
								do{
									if($rowroom["Description"] == $rowx["Description"]){
										$cnt -= $rowx["countchkin"];
									}
								}while($rowx = mysqli_fetch_array($resx));
							}
	
	//subtract all these to know the rooms available for room transfer (dapat may atleast one na makuha para masabing available ung room for transfer)
	if($cnt > 0){
		//check room price
			$pricex = $rowroom["Price"];
			if($pricex >= $price){	//show all rooms of this room type
				$roomtypeid = $rowroom["rmID"];
				$output = "SELECT * FROM room WHERE RoomTypeID=$roomtypeid AND room.Status='AVAILABLE'";
				$resoutput = mysqli_query($conn, $output);
				$rowoutput = mysqli_fetch_array($resoutput);
				if(mysqli_num_rows($resoutput) != 0){
					do{
						$rmnumout = $rowoutput["RoomNumber"];
						echo "<option value='$rmnumout'>$rmnumout</option>";
					}while($rowoutput = mysqli_fetch_array($resoutput));
				}
			}
	}
			}while($rowroom = mysqli_fetch_array($resroom));
	}
	
	echo "</select>";
	//next validation (dapat mas mahal sya dun sa dating price)
	}
	    
	}
?>