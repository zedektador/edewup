<?php
include("weblock.php");
date_default_timezone_set("Asia/Manila");
$today = date("Y-m-d");
if(isset($_GET["id"])){
			  ?>
			<center><h2 style="font-size:30px">Assign Room</h2></center>
					<?php
				if(isset($_GET["mess"])){
						?>
				  <div class="
				  <?php 
				  if($_GET["mess"] == "The rooms you selected do not match the actual number of rooms.")
				  {
					  echo "alert alert-warning alert-dismissible fade in";
				  }
				  else{
					  echo "alert alert-success alert-dismissible fade in";
				  }
				  ?>" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["mess"]; ?></strong></center>
					
                  </div>
					  <?php
					  }
					  ?>
					  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/reservation_list.php?id=<?php echo $_GET["id"]; ?>');
					</script>
					
				
				<div class="x_panel">
                  <div class="x_content">
					<form id="chk" action="chkin_process_res1.php" method="post">
					<table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:20%">Room Number</th>
                           <th style="width:30%">Image</th>
                          <th style="width:15%">Room Type</th>
                          <th style="width:25%">Description</th>
                          <th style="width:10%">Capacity</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
							//get per room
								//count per room type then get room id
								
							$resid_ = $_GET["id"];	
							$getperroom = "SELECT *, COUNT(*) as cntperroom FROM room_reservation JOIN room ON room.RoomNumber=room_reservation.RoomNumber JOIN room_type ON room_type.RoomTypeID=room.RoomTypeID WHERE room_reservation.ReservationID=$resid_ GROUP BY room_type.Description";
							$resperroom = mysqli_query($conn, $getperroom);
							$rowperroom = mysqli_fetch_array($resperroom);
							$perroom_ = "";
							$message = "";
							if(mysqli_num_rows($resperroom) != 0){
								do{
									$perroom_ .= $rowperroom["cntperroom"].",".$rowperroom["RoomTypeID"].";";
									$message .= $rowperroom["cntperroom"]." ".$rowperroom["Description"].", ";
								}while($rowperroom = mysqli_fetch_array($resperroom));
							}
						
							$perroom = rtrim($perroom_, ';');
							$arrayvar = explode(";",$perroom);
							foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									$rmselected = "";
									if($quantity != 0){
										//get room price
										$rooms = "SELECT *, room_type.RoomTypeID as rtid FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room.Status='AVAILABLE' AND room_type.RoomTypeID=$roomnum GROUP BY room_type.Description";
										$res = mysqli_query($conn, $rooms);
										$row = mysqli_fetch_array($res);
										if(mysqli_num_rows($res) != 0){
										do{
												$roomtype = $row["Description"];
												$about = $row["AboutRoom"];
												$cap = $row["Capacity"];
												$pic = $row["RoomPic"];
												$rn = $row["RoomNumber"];
												$rtid = $row["rtid"];
											?>
					
						<tr>
						    <td>
							 <table class="table table-hover">
							     <?php
							     $ind = "SELECT * FROM room WHERE RoomTypeID=$rtid AND Status='AVAILABLE'";
							     $resind = mysqli_query($conn, $ind);
							     $rowind = mysqli_fetch_array($resind);
							     if(mysqli_num_rows($resind) != 0){
							       do{
							           $rnx = $rowind["RoomNumber"];
							     ?>
							     <tr>
							     <td><center><input type="checkbox" class="checkbox" name="rmnumber[]" value="<?php echo $rnx; ?>"></center></td>
								<td><?php echo $rnx; ?></td>
							    </tr>
							     <?php
							       }while($rowind = mysqli_fetch_array($resind));
							     }
							     ?>
							 </table>
							</td>
							<td><center><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $pic ).''; ?>" style="max-height:260px" class="img-responsive" alt=""></center></	td>
							<td><?php echo $roomtype; ?></td>
							<td><?php echo $about; ?></td>
							<td><?php echo $cap; ?></td>
                        </tr>
					  
											<?php	
										}while($row = mysqli_fetch_array($res));
										}
									}
								}
							?>
							</tbody>
						</table>
						<input type="text" id="mess_" value="<?php 
						$messy = rtrim($message, ', ');
						echo $messy; ?>" hidden readonly>
						<input type="text" name="in_id" value="<?php echo $_GET["id"]; ?>" hidden readonly>
						<input type="text" name="roomselected" value="<?php echo $perroom_; ?>" hidden readonly>
						<br><br>
						<button style="float:right;" type="submit" id="cnf" name="checkin_" onclick="return wait()" class="btn btn-primary" disabled>Check-in</button>
						<br><br><br>
						<script>
							var mess = $("#mess_").val();
							swal("Reserved Rooms", mess, "warning");
						</script>
						</form>
					</div>
					</div>
                 			
		<?php
		}
		elseif(isset($_GET["view"])){
?>
		<?php
		//get details given resid 
		session_start();
		$residview = $_GET["view"];
		$getdet = "SELECT *, reservation.Status as rmstat FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE reservation.ReservationID=$residview";
		$resdet = mysqli_query($conn, $getdet);
		$rowdet = mysqli_fetch_array($resdet);
		
		$mat = $rowdet["Mattress"];
		
		$days = round((strtotime($rowdet["CheckoutDate"]) - strtotime($rowdet["CheckinDate"]))/60/60/24);
		$_SESSION["bookCode"] = $rowdet["ResCode"];
		?>
		 <div class="right_col" role="main">
		<div style="width: 100%; margin: auto;">
				
				<div class="x_panel">
                  <div class="x_content">
					<center><h2 style="font-size:30px">Reservation Summary</h2></center>
					<br><br>
					<center>
					<table class="table table-hover">
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Name: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo $rowdet["Name"]; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Check-in Date: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($rowdet["CheckinDate"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Check-out Date: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo date_format(date_create($rowdet["CheckoutDate"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Days: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Guest(s): </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $rowdet["Guests"]; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight: bold">Room(s): </td>
							<td style="width:70%; font-size: 15px;">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;"></td>
						</tr>
						<tr>
								
								<td colspan=2>
								<table class="table table-hover">
									<tr>
										<td style="width:20%; font-size: 15px;">Room Type</td>
										<td style="width:20%; font-size: 15px;">Room Price</td>
										<td style="width:20%; font-size: 15px;">Quantity</td>
										<td style="width:20%; font-size: 15px;">Capacity</td>
										<td style="width:20%; font-size: 15px;">Amount</td>
									</tr>
								<?php
								$getperroom = "SELECT *, COUNT(*) as cntperroom FROM room_reservation JOIN room ON room.RoomNumber=room_reservation.RoomNumber JOIN room_type ON room_type.RoomTypeID=room.RoomTypeID WHERE room_reservation.ReservationID=$residview GROUP BY room_type.Description";
								$resperroom = mysqli_query($conn, $getperroom);
								$rowperroom = mysqli_fetch_array($resperroom);
								$perroom_ = "";
								
								if(mysqli_num_rows($resperroom) != 0){
								do{
									$perroom_ .= $rowperroom["cntperroom"].",".$rowperroom["RoomTypeID"].";";
								}while($rowperroom = mysqli_fetch_array($resperroom));
								}
								
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$additional = 0;
								$totalcap = 0;
								$remguest = $rowdet["Guests"];
								foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									if($quantity != 0){
										//get room price
										$price = "SELECT * FROM room_type WHERE RoomTypeID=$roomnum";
										$res = mysqli_query($conn, $price);
										$row = mysqli_fetch_array($res);
										$roomtype = $row["Description"];
										$rprice = $row["Price"];
										$sub = $rprice * $days *$quantity;
										$cap = $row["Capacity"];
										$add = $row["AdditionalPerHead"];
											$additional += ($add * $remguest);
											$remguest -= $cap * $quantity;
											$totalcap += $cap * $quantity;
											//compute for additional per head
									?>
									<tr>
										<td style="font-size: 15px;"><?php echo $roomtype; ?></td>
										<td style="font-size: 15px;"><?php echo "Php ".number_format($rprice, 2); ?></td>
										<td style="font-size: 15px;"><?php echo $quantity; ?></td>
										<td style="font-size: 15px;"><?php echo $cap; ?></td>
										<td style="font-size: 15px;"><?php echo "Php ".number_format($sub, 2); ?></td>
									</tr>
									<?php
									$totalsub += $sub;
									}
								}
								?>
								</table>
								</td>
						</tr>
						<?php   
						$guest = $rowdet["Guests"];
						    $ex = $guest - $totalcap;
							if($ex < 0){
							    $ex = 0;
							}
							if($ex > 0){
							    //get price of mattress from settings
							    $genmat = "SELECT * FROM settings WHERE SettingsID=1";
							    $resmat = mysqli_query($conn, $genmat);
							    $rowmat = mysqli_fetch_array($resmat);
							    $prmat = $rowmat["MattressPrice"];
						?>	
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight: bold">Note for Extra Persons: </td>
							<td style="width:70%; font-size: 18px;">
								&nbsp;
							</td>
						</tr>	
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Extra Persons: </td>
							<td style="width:50%; font-size: 15px;"><?php echo $ex." pax"; ?></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Extra Mattress (Php <?php echo number_format($prmat, 2); ?> each): </td>
							<td style="width:50%; font-size: 15px;">
							    <?php echo "".$mat; ?>
							</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Additional Charges:</td>
							<td style="width:50%; font-size: 15px;">
							    <?php echo "Php ".number_format($prmat * $mat, 2); ?>
							</td>
						</tr>
						<?php
							}
							?>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">Payment Details</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Room Fee: </td>
							<td style="width:70%; font-size: 15px;"><?php echo "Php ".number_format($totalsub, 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Vatable Amount:</td>
							<td style="width:70%; font-size: 15px;"><?php $total_ = $totalsub + $additional + ($prmat * $mat);
								echo "Php ".number_format($total_/1.12, 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">VAT (12%):</td>
							<td style="width:70%; font-size: 15px;"><?php $total_ = $totalsub + $additional + ($prmat * $mat);
								echo "Php ".number_format(($total_/1.12)*0.12, 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Amount: </td>
							<?php
								$total_ = $totalsub + $additional + ($prmat * $mat);
								//get maxreserve days from settings
									$settings = "SELECT * FROM settings WHERE SettingsID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
							?>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" id="total" style="background-color: transparent; border: 0px;" value="<?php echo number_format($total_, 2); ?>"></td>
						</tr>
						
						
						<?php
						//check if it is paid or not
						if($rowdet["rmstat"] == "PAID"){
							$paid = $rowdet["DownpaymentPaid"];
							$balance = $rowdet["RemainingBalance"];
						?>	
						
						<tr>
							<td style="width:30%; font-size: 15px;">Amount Paid: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($paid, 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Remaining Balance: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($balance, 2); ?></td>
						</tr>
					</table>
					</center>
					<br><br><br>
					<center><h4 style="font-weight: bold">Important Reminders</h4></center><br>
					<center>
					<div style="margin-left:100px; margin-right: 100px;">
					<p style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please bring the itinerary receipt emailed to you upon check-in together with the bank slip or official receipt as proof of payment. Thank you for patronizing Montalban Waterpark and Garden Resort. See you on <?php echo date_format(date_create($rowdet["CheckinDate"]), "F j, Y"); ?>.</p>
					</div>
					</center>
					<br><br>
					
						<?php
						}
						else{ //PENDING
							$resdatex = $rowdet["ReservationDate"];
							$NewDate=date("F j, Y", strtotime("$resdatex +$resday days" ));
						?>
						
						<tr>
							<td style="width:30%; font-size: 15px;">Deadline of Downpayment: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold"><?php echo $NewDate; ?></td>
						</tr>
					</table>
					</center>
					<br><br><br>
					<center><h4 style="font-weight: bold">Payment Instruction</h4></center>
					<?php
						$settings = "SELECT * FROM settings WHERE SettingID=1";
						$resset = mysqli_query($conn, $settings);
						$rowset = mysqli_fetch_array($resset);
					?>
					<br>
					<div style="margin-left:100px; margin-right: 100px;">
					<p style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please deposit the amount on the bank information provided in the emailed itinerary receipt.</p>
					<p style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to settle the payments before the due date will cause the expiration of your reservation.</p>
					<p style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There is strictly <b>no refund</b> for payments made but should you decide to change rooms and dates, <b>rescheduling of reservation</b> is possible.</p>
					</div>
					<br><br>
					
						<?php
						}
						?>
					<a href="reservation_list.php"><button style="float:right" class="btn btn-success">Back</button></a>
					<?php
					if($rowdet["rmstat"] == "PAID"){
					?>
					<a href="reservation_list.php?edit=<?php echo $_GET["view"]; ?>"><button style="float:right" class="btn btn-danger">Edit Reservation</button></a>
					<br><br>
					<?php
					}
					?>
					
			 </div>
			 </div>
			 </div>
			 </div>

<?php	
		}
		elseif(isset($_GET["rm"])){
?>

		<div class="right_col" role="main">
		<div style="width: 100%; margin: auto;">
				
				<center><h2 style="font-size:30px">Edit Reservation</h2></center>
				<div class="x_panel">
                  <div class="x_content">
				  <div style="width:100%; margin:auto">
							 <div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 2</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:50px">
							<center><label>Choose preferred room(s)</label></center>
                        </div>
                      </div>
							 
							 <div class="col-lg-12 text-center" style="clear:both">
				<table class="table table-hover">
					<tr style="height:60px; text-align: center; font-weight: bold;">
					<td style="width:30%"><h4 style="font-weight:bold">Room Picture</h4></td>
					<td style="width:57%"><h4 style="font-weight:bold">Description</h4></td>
					<td style="width:13%"><h4 style="font-weight:bold">Quantity</h4></td>
					</tr>
				<?php
				$in__ = $_SESSION["ed_in"];
				$out__ = $_SESSION["ed_out"];
				
					$sqlroom = "SELECT *, COUNT(*) as cntroom FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID GROUP BY room_type.RoomTypeID";
					$resroom = mysqli_query($conn, $sqlroom);
					$rowroom = mysqli_fetch_array($resroom);
					$cntroom = mysqli_num_rows($resroom);
				
					
					if(mysqli_num_rows($resroom) != 0){
					do{
					//sureball availability query		
					$sqlres = "SELECT *, COUNT(*) AS count FROM reservation JOIN room_reservation ON reservation.ReservationID=room_reservation.ReservationID JOIN room ON room_reservation.RoomNumber=room.RoomNumber JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE (('$out__' > reservation.CheckinDate AND '$out__' <= reservation.CheckoutDate) OR ('$in__' >= reservation.CheckinDate AND '$in__' < reservation.CheckoutDate) OR ('$in__' >= reservation.CheckinDate AND '$in__' < reservation.CheckoutDate) OR ('$out__' < reservation.CheckoutDate AND '$out__' >= reservation.CheckinDate) OR ('$in__' <= reservation.CheckinDate AND '$out__' >= reservation.CheckoutDate)) AND reservation.Status IN ('PENDING', 'PAID', 'WAITING') GROUP BY Description";
					
					
					//to be edited
					$sqlchk = "SELECT *, COUNT(*) as countchkin FROM room LEFT JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room.Status!='AVAILABLE' GROUP BY room_type.Description";
					
					$res = mysqli_query($conn, $sqlres);
					$row = mysqli_fetch_array($res);
					
					$resx = mysqli_query($conn, $sqlchk);
					$rowx = mysqli_fetch_array($resx);
							$cnt = $rowroom["cntroom"];
							if(mysqli_num_rows($res) > 0){
								do{
									if($rowroom["Description"] == $row["Description"]){
										$cnt -= $row["count"];
									}
								}while($row = mysqli_fetch_array($res));
							}
							if(mysqli_num_rows($resx) > 0){
								do{
									if($rowroom["Description"] == $rowx["Description"]){
										$cnt -= $rowx["countchkin"];
									}
								}while($rowx = mysqli_fetch_array($resx));
							}
							if($cnt > 0){
					?>
				
				<tr>
					<td style="padding-top:20px;padding-bottom:20px"><center>
					<img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $rowroom['RoomPic'] ).''; ?>" style="max-height:260px; max-width: 270px" class="img-responsive" alt="">
					</center>
					</td>
					<td style=" text-align: left; margin-bottom:20px;">
					<div style="margin-left: 50px; margin-top:30px;">
					<h4 style="font-weight:bold"><?php echo $rowroom["Description"]; ?></h4>
					<h5 style="font-weight:bold">Price: <span style="font-weight:normal"><?php echo "Php ".number_format($rowroom["Price"], 2); ?></span></h5>
					<h5 style="font-weight:bold">Capacity: <span style="font-weight:normal"><input type="text" id="<?php echo $rowroom["RoomTypeID"]."c"; ?>" name="capacity[]" class="capacity" readonly style="width:40px; background-color: transparent; border: 0px; text-align: center" value="<?php echo $rowroom["Capacity"]; ?>"><span></h5>
					<h5 style="font-weight:bold">Additional Per Head: <?php
						if($rowroom["AdditionalPerHead"] != null){
						?>
						<span style="font-weight:normal"><?php echo "Php ".number_format($rowroom["AdditionalPerHead"], 2); ?></span>
						<?php
						}
						else{
						?>
							<span style="font-weight:normal"><?php echo "Free"; ?></span>
						<?php
						}
						?></h5>	
					<h5 style="font-weight:bold">Available Rooms: <span style="font-weight:normal"><input type="text" id="<?php echo $rowroom["RoomTypeID"]."av"; ?>" readonly style="width:40px; background-color: transparent; border: 0px; text-align: center" value="<?php echo $cnt; ?>"></span></h5>
						<h5 style="font-weight:bold">Description: </h5><p><i><?php echo $rowroom["AboutRoom"]; ?></i></p>
						</div>
						</td>
						<th><center><input id="<?php echo $rowroom["RoomTypeID"]."nr"; ?>" style="width:50%; text-align: right" min="0" max="<?php echo $cnt; ?>" value="0" type="number" class="quan" name=""></center></th>
							<input id="<?php echo $rowroom["RoomTypeID"]."cap"; ?>" type="number" class="totalcap" value="0" hidden>
							<input id="<?php echo $rowroom["RoomTypeID"]."ses"; ?>" type="text" class="forsess" value="0,<?php echo $rowroom["RoomTypeID"]; ?>" hidden>
						</tr>
				
				<script>
					$("#<?php echo $rowroom["RoomTypeID"]; ?>nr").bind('keyup mouseup', function() {
						var totalcap = parseInt($("#<?php echo $rowroom["RoomTypeID"]; ?>nr").val()) * parseInt($("#<?php echo $rowroom["RoomTypeID"]; ?>c").val());
						var valOfRm = $("#<?php echo $rowroom["RoomTypeID"]; ?>nr").val();
						$("#<?php echo $rowroom["RoomTypeID"]; ?>cap").val(totalcap);
						$("#<?php echo $rowroom["RoomTypeID"]; ?>ses").val(valOfRm+","+<?php echo $rowroom["RoomTypeID"]; ?>);
					});
					
					var resxx = $("#<?php echo $rowroom["RoomTypeID"]; ?>av").val();
					$("#<?php echo $rowroom["RoomTypeID"]; ?>nr").attr("max", parseInt(resxx));
				</script>
				
					<?php		
							}
						}while($rowroom = mysqli_fetch_array($resroom));
					}
					
				//checkin 
				
			 ?>
			 </table>
			 </div>
					  
			<div style="clear:both; height:20px"></div>
			<button style="float:right;" id="next" name="next" class="btn btn-primary">Next</button>
			<a href="reservation_list.php?edit=<?php echo $_GET["rm"]; ?>"><button style="float:right;" type="" id="edit" name="" onclick="return step()" class="btn btn-danger">Edit Details</button></a>
			<br><br>
					  </div>
				  </div>
				 </div>
		</div>
		</div>

<?php
		}
		elseif(isset($_GET["rm2"])){
?>

		<div class="right_col" role="main">
		<div style="width: 100%; margin: auto;">
				
				<center><h2 style="font-size:30px">Edit Reservation</h2></center>
				<div class="x_panel">
                  <div class="x_content">
				  
				  <div style="width: 80%; margin: auto;">
				<br>
						<div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 4</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
							<center><label>Reservation Summary</label></center>
                        </div>
                      </div>
					<br>
					<table class="table table-hover">
						<?php
							$days = round((strtotime($_SESSION["ed_out"]) - strtotime($_SESSION["ed_in"]))/60/60/24);
						?>
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Name: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo $_SESSION["ed_name"]; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Check-in Date: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($_SESSION["ed_in"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Check-out Date: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo date_format(date_create($_SESSION["ed_out"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Days: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Guest(s): </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $_SESSION["ed_guest"]; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight: bold">Room(s): </td>
							<td style="width:70%; font-size: 15px;">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;"></td>
						</tr>
						<tr>
								
								<td colspan=2>
								<table class="table table-hover">
									<tr>
										<td style="width:20%; font-size: 15px;">Room Type</td>
										<td style="width:20%; font-size: 15px;">Room Price</td>
										<td style="width:20%; font-size: 15px;">Quantity</td>
										<td style="width:20%; font-size: 15px;">Capacity</td>
										<td style="width:20%; font-size: 15px;">Amount</td>
									</tr>
								<?php
								$perroom_ = $_SESSION["ed_numperroom"];
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$totalcap = 0;
								$additional = 0;
								$remguest = $_SESSION["ed_guest"];
								foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									if($quantity != 0){
										//get room price
										$price = "SELECT * FROM room_type WHERE RoomTypeID=$roomnum";
										$res = mysqli_query($conn, $price);
										$row = mysqli_fetch_array($res);
										$roomtype = $row["Description"];
										$rprice = $row["Price"];
										$sub = $rprice * $days *$quantity;
										$cap = $row["Capacity"];
										$add = $row["AdditionalPerHead"];
											$additional += ($add * $remguest);
											$remguest -= $cap * $quantity;
											$totalcap += $cap * $quantity;
											//compute for additional per head
									?>
									<tr>
										<td style="font-size: 15px;"><?php echo $roomtype; ?></td>
										<td style="font-size: 15px;"><?php echo "Php ".number_format($rprice, 2); ?></td>
										<td style="font-size: 15px;"><?php echo $quantity; ?></td>
										<td style="font-size: 15px;"><?php echo $cap; ?></td>
										<td style="font-size: 15px;"><?php echo "Php ".number_format($sub, 2); ?></td>
									</tr>
									<?php
									$totalsub += $sub;
									}
								}
								?>
								</table>
								</td>
						</tr>	
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<?php   
						    $number = $_SESSION["ed_guest"];
						    $total_ = $totalsub + $additional;
							$ex = $number - $totalcap;
							if($ex < 0){
							    $ex = 0;
							}
							if($ex > 0){
							    //get price of mattress from settings
							    $genmat = "SELECT * FROM settings WHERE SettingsID=1";
							    $resmat = mysqli_query($conn, $genmat);
							    $rowmat = mysqli_fetch_array($resmat);
							    $prmat = $rowmat["MattressPrice"];
						?>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight: bold">Note for Extra Persons: </td>
							<td style="width:70%; font-size: 15px;">
								&nbsp;
							</td>
						</tr>	
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Extra Persons: </td>
							<td style="width:50%; font-size: 15px;"><?php echo $ex." pax"; ?></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Extra Mattress (Php <?php echo number_format($prmat, 2); ?> each): </td>
							<td style="width:50%; font-size: 15px;">
							    <input type="number" name="mat" style="width:50%" id="mat" min="1" max="100" value="1">
							</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Additional Charges:</td>
							<td style="width:50%; font-size: 15px;">Php&nbsp; 
							    <input type="number" style="border:0px; width:50%" id="add" readonly value="<?php echo number_format($prmat, 2); ?>">
							</td>
						</tr>
						<script>
						    $("#mat").on('keyup', function () {
						        var ch = parseFloat($("#mat").val());
						       
						        if(isNaN(ch)){
						            ch = 0;
						        }
						        if(ch <= 1){
						            ch = 1;
						        }
						        //var g = parseFloat($("#add").val());
						        var totalch = ch * <?php echo $prmat; ?>;
						        var vat = parseFloat((totalch + <?php echo $total_; ?>)/1.12).toFixed(2);
						        var vatx = parseFloat(((totalch + <?php echo $total_; ?>)/1.12)*0.12).toFixed(2);
						        var tot = parseFloat(totalch + <?php echo $total_; ?>).toFixed(2);
						        var t = parseFloat($("#totalz").val());
						        var newbal = parseFloat(tot - t).toFixed(2);
						        
						        $("#add").val(totalch);
						        $("#vat").val(vat);
						        $("#vatx").val(vatx);
						        $("#tot").val(tot);
						        $("#newbal").val(newbal);
						    });
						</script>
						<?php
							}
							else{
					    ?>
					        <input type="number" hidden name="mat" style="width:50%" id="mat" min="1" max="100" value="0">
					    <?php
							}
						?>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr><tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">Payment Details</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Total Room Fee: </td>
							<td style="width:50%; font-size: 15px;"><?php echo "Php ".number_format($totalsub, 2); ?></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Vatable Amount:</td>
							<td style="width:50%; font-size: 15px;">
							 Php&nbsp;<input type="number" style="border:0px; width:50%" id="vat" readonly value="<?php 
							 echo str_replace(",", "", number_format(($total_ + $prmat)/1.12, 2)); ?>"></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">VAT (12%):</td>
							<td style="width:50%; font-size: 15px;">
							       Php&nbsp;<input type="number" style="border:0px; width:50%" id="vatx" readonly value="<?php 
							 echo str_replace(",", "", number_format((($total_ + $prmat)/1.12)*0.12, 2)); ?>">
							</td>
						</tr>
						
						<tr>
							<td style="width:50%; font-size: 15px;">Total Amount:</td>
							<td style="width:50%; font-size: 15px; font-weight: bold" id="total">
							    Php&nbsp;<input type="number" name="total" style="border:0px; width:50%" id="tot" readonly value="<?php 
							 echo str_replace(",", "", number_format($total_ + $prmat, 2)); ?>">
							</td>
						</tr> 
						<tr>
							<td style="width:30%; font-size: 15px;">Amount Paid: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php
							    <input type="number" id="totalz" readonly style="border:0px" value="<?php echo str_replace(",", "", number_format($_SESSION["ed_paid"], 2)); ?>"></td>
						</tr>
						<tr>
						    <?php 
							$hi = ($total_ + $prmat) - $_SESSION["ed_paid"];
							session_start();
							$_SESSION["new_b"] = $hi;
							if($hi < 0){
								$hi = 0;
							}
							?>
							<td style="width:30%; font-size: 15px;">New Balance: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="number" name="newbal" style="border:0px; width:50%" id="newbal" readonly value="<?php echo str_replace(",","", number_format($hi, 2)); ?>"></td>
						</tr>
					</table>
					<br><br><br>
					<center><h4 style="font-weight: bold">A new reservation slip will be sent to your email address.</h4></center><br><br>
					<div class="col-md-12" style="margin-bottom:20px">
					</div>
					<center>
			<a href="reservation_list.php?edit=<?php echo $_GET["rm2"]; ?>"><button type="" id="edit2" name="" class="btn btn-danger">Edit Details</button></a>
			 		<button id="confirm" class="btn btn-success">Confirm Reservation</button>
			 </center>
			 <br><br>
			 </div>
				  
				  
				  </div>
				 </div>
		</div>
		</div>

<?php
		}
		elseif(isset($_GET["edit"])){
?>

		<div class="right_col" role="main" style="height: 500px;">
		<div style="width: 100%; margin: auto;">
				
				<center><h2 style="font-size:30px">Edit Reservation</h2></center>
				
				<?php
				$idres = $_GET["edit"];
				$q = "SELECT * FROM reservation WHERE ReservationID=$idres";
				$r = mysqli_query($conn, $q);
				$roww = mysqli_fetch_array($r);
				$inx = $roww["CheckinDate"];
				$outx = $roww["CheckoutDate"];
				$g = $roww["Guests"];
				
				?>
				<div class="x_panel">
                  <div class="x_content">
				  <div style="width:40%; margin:auto">
							 <form action="session_checkin_edit.php" method="post">
							 <div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 1</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
							<center><label>Fill-up the following fields</label></center>
                        </div>
                      </div>
							 
							 <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Check-in Date:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						 <input type="text" name="rid" hidden readonly value="<?php echo $idres; ?>">
						  <input type="date" class="form-control" id="txtDate" name="in" onchange="updDate()" value="<?php echo $inx; ?>" required>
                        </div>
                      </div>
					  
					  
							<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Check-out Date:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="date" class="form-control" value="<?php echo $outx; ?>" id="txtDateOut" name="out" required>
                        </div>
                      </div>
					  
						<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Guest:</label>
                        </div>
						 <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom:50px">
						  <input type="number" class="form-control"  value="<?php echo $g; ?>" name="guest" required>
                        </div>
                      </div>
					  
					  <button style="float:right; clear:both;" type="submit" id="submitSN" name="submit" class="btn btn-primary">Submit</button>
					  </form>
						</div>
				  </div>
				 </div>
		</div>
		</div>
		
<?php
		}
		else{
?>
		<!-- page content -->
        
				<center><h2 style="font-size:30px">Reservation List</h2></center>
				
						<?php
					  if(isset($_GET["message"])){
						 ?>
					<div class="	 
						 <?php
						  if($_GET["message"] == "Guest successfully checked-in!" || $_GET["message"] == "Reservation successfully cancelled" || $_GET["message"] == "Successfully edited reservation." || $_GET["message"] == "Successfully recorded payment."){
							echo "alert alert-success alert-dismissible fade in";
						  }else{
							  echo "alert alert-warning alert-dismissible fade in";
						  }

						?>" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
					  <?php
					  }
					  ?>
				<script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/reservation_list.php');
					</script>
				
				<div class="x_panel">
                  <div class="x_content">
					<table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:18%">Client Name</th>
						  <th style="width:8%">Res Code</th>
                          <th style="width:8%">Res Date</th>
                          <th style="width:8%">In Date</th>
                          <th style="width:9%">Out Date</th>
                          <th style="width:5%">Guests</th>
                          <th style="width:8%">Extra Mattress</th>
                          <th style="width:9%">Status</th>
                          <th style="width:27%">Action </th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$sqlquery = "SELECT *, reservation.Status as resSt FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE reservation.Status IN ('PAID', 'PENDING')";
						$res = mysqli_query($conn, $sqlquery);
						$rowStud = mysqli_fetch_array($res);
						if(mysqli_num_rows($res) == 0){
							echo "
								<tr><td colspan='9'><center>No records found.</center></td></tr>
							";
						}
						else{
						do{
						$reserid = $rowStud["ReservationDate"];
						$in = $rowStud["CheckinDate"];
						$out = $rowStud["CheckoutDate"];
						$code = $rowStud["ResCode"];
						$guest = $rowStud["Guests"];
						$status = $rowStud["resSt"];
						$name = $rowStud["Name"];
						$mat = $rowStud["Mattress"];
						$resid = $rowStud["ReservationID"];
						$amttopay = $rowStud["TotalBill"] /2;
						?>
						<tr>
                          <td><?php echo $name; ?></td>
                          <td><?php echo $code; ?></td>
                          <td><?php echo date_format(date_create($reserid), "M j, Y"); ?></td>
                          <td><?php echo date_format(date_create($in), "M j, Y"); ?></td>
                          <td><?php echo date_format(date_create($out), "M j, Y"); ?></td>
                          <td><?php echo $guest; ?></td>
                          <td><?php echo $mat; ?></td>
                          <td><?php echo $status; ?></td>
                          <?php
						  if($status == "PENDING"){
						  ?>
						  <td><center><button onclick="openModal(this.id)" type="button" id="<?php echo $resid.";".$amttopay; ?>" class="btn btn-round btn-success btn-sm">Payment</button>
						  
						  <?php
						  }
						  elseif($status == "PAID" AND $in <= date("Y-m-d")){
						  ?>
						  <td><center><a href="walk_checkin.php?cdid=<?php echo $resid; ?>"><button type="button" id="" class="btn btn-round btn-success btn-sm">Check-in</button></a>
						  <?php
						  }
						  else{
						  ?>
						      <td>
						  <?php
						  }
						  ?>
						  <a href="reservation_list.php?view=<?php echo $resid; ?>"><button type="button" id="" class="btn btn-round btn-warning btn-sm">View Details</button></a>
						  <button type="button" id="<?php echo $resid; ?>" onclick="cancel(this.id)" class="btn btn-round btn-danger btn-sm">Cancel</button>
						  </center></td>
                         </tr>
						<?php
						}while($rowStud = mysqli_fetch_array($res));
						}
						?>
                      </tbody>
                    </table>
                  </div>
				
				
                </div>
				
		
		<?php
		
		}
		
		?>
        <!-- /page content -->
		
		<!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="payment.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Reservation Payment</h4>
                        </div>
                        <div class="modal-body">
                <center>
             <div id="messin" style="font-size:15px; font-weight: bold">Amount to Pay (50%):  </div>
			  <div>
                <input type="number" name="" id="amtToPay" class="form-control" readonly style="width:70%" min="1000"/>
              </div>
			  <br><br>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Reservation Payment:</div>
			  <div>
                <input type="number" name="amt" id="amt" class="form-control" placeholder="0.00" required="" style="width:70%"/>
              </div>
			  <br><br>
			  <div id="messin" style="font-size:15px; font-weight: bold">Rendered Amount:</div>
			  <div>
				<input type="text" id="resmod" hidden readonly name="resid">
                <input type="number" name="amtrendered" id="amtrendered" class="form-control" placeholder="0.00" required="" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="pay" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
				  
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
		<script type="text/javascript">
$("#confirm").click(function (){
    var total = $("#newbal").val();    
    var mat = $("#mat").val();
    
   window.location.href="save_resched.php?total="+total+"&mat="+mat; 
});

//done
$("#respay").submit(function(){
	var amt = parseInt($("#amt").val());
	var ren = parseInt($("#amtrendered").val());
	
	if(amt > ren){
		swal("Validation", "Payment for reservation should not be greater than rendered amount.", "warning");
		return false;
	}
});

$("#amt").on("keyup", function (){
   $("#amtrendered").attr("min", $(this).val());
});


function openModal(id){
            //token the id;
            //id;amttopay
            var res = id.split(";");
            
				$('#modal').modal('show');
				$("#resmod").val(res[0]);
				$("#amtToPay").val(parseFloat(res[1]).toFixed(2));
				$("#amt").attr("min", parseFloat(res[1]));
				$("#amt").attr("max", (parseFloat(res[1]) * 2));
			}
	
	Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}		
		
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + (day);
	$('#txtDate').attr('min', maxDate);
	$('#txtDate').val(maxDate);
	
	var inDate = $("#txtDate").val();
	var inDate_ = new Date(inDate);
	var inDatex = inDate_.addDays(1);
    var month_ = inDatex.getMonth() + 1;
    var day_ = inDatex.getDate();
    var year_ = inDatex.getFullYear();
    if(month_ < 10)
        month_ = '0' + month_.toString();
    if(day_ < 10)
        day_ = '0' + day_.toString();
	var tomorrow = year_ + '-' + month_ + '-' + (day_);
	
	$('#txtDateOut').attr('min', tomorrow);
	$('#txtDateOut').val(tomorrow);
});



function updDate(){
	var inDate = $("#txtDate").val();
	var inDate_ = new Date(inDate);
	var inDatex = inDate_.addDays(1);
    var month_ = inDatex.getMonth() + 1;
    var day_ = inDatex.getDate();
    var year_ = inDatex.getFullYear();
    if(month_ < 10)
        month_ = '0' + month_.toString();
    if(day_ < 10)
        day_ = '0' + day_.toString();
	var tomorrow = year_ + '-' + month_ + '-' + (day_);
	
	$('#txtDateOut').attr('min', tomorrow);
	$('#txtDateOut').val(tomorrow);
    
    //alert("x")
}

function cancel(id){
swal({
  title: "Are you sure?",
  text: "Reservation is about to be cancelled! Do you want to proceed?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, cancel it!",
  closeOnConfirm: false
},
function(isConfirm) {
	if (isConfirm) {
			$.ajax({
				url: "cancel.php",
				method: "post",
				data: {
					id: id
				},
				success: function(res){
					window.location.href="reservation_list.php?message=Reservation successfully cancelled";
				}
			});
		}
		else{
			return false;
		}
    });
}



var maxRoom = 0;

function max(){
	$.ajax({
		url: "settings_maxRooms.php",
		success: function(res){
			maxRoom = res;
		}
	});
}



var maxRoom = 0;

function max(){
	$.ajax({
		url: "settings_maxRooms.php",
		success: function(res){
			maxRoom = res;
		}
	});
	
	updDate
}


$(".quan").on('keydown', function (event) {

    //up-arrow (regular and num-pad)
    if (event.which == 38 || event.which == 104) {
			return true;
	//down-arrow (regular and num-pad)
	} else if (event.which == 40 || event.which == 98) {
		return true;
    }
	else{
		return false;
	}
});



$('.checkbox').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){
			  $("#cnf").prop("disabled", false);
		  }else{
			  $("#cnf").prop("disabled", true);
		  }
});


function wait(){

swal({
  title: "Proceed?",
  text: "Be sure that the selected rooms match the number or rooms per room type requested by the client!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, proceed!",
  closeOnConfirm: false
},
function(){
  //redirect page;
  document.getElementById("chk").submit();
});
	
	return false;
	}



</script>