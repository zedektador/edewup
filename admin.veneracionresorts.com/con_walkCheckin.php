<?php
include("weblock.php");
?>
		<style>
		h4{
			font-weight: bold;
		}
		</style>
		<!-- page content -->
        <div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
			
				<center><h2 style="font-size:30px">Check-in</h2></center>
				
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
				  ?>
				  " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["mess"]; ?></strong></center>
					<script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/walk_checkin.php');
					</script>
                  </div>
					  <?php
					  }
				?>
				
				<div class="x_panel">
                  <div class="x_content">
						<?php
						if(isset($_GET["cdid"])){
	                    $resid = $_GET["cdid"];
	                    session_start();
	                    $_SESSION["resid"] = $resid;
	                    $_SESSION["x"] = "yes";
	                    
	                        $cdidsql = "SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE reservation.ReservationID=$resid";
	                        $rescdid = mysqli_query($conn, $cdidsql);
	                        $rowcdid = mysqli_fetch_array($rescdid); 
	                    	$_SESSION["a_out"] = $rowcdid["CheckoutDate"];
	                    	
	                    	$getperroom = "SELECT *, COUNT(*) as cntperroom FROM room_reservation JOIN room ON room.RoomNumber=room_reservation.RoomNumber JOIN room_type ON room_type.RoomTypeID=room.RoomTypeID WHERE room_reservation.ReservationID=$resid GROUP BY room_type.Description";
							$resperroom = mysqli_query($conn, $getperroom);
							$rowperroom = mysqli_fetch_array($resperroom);
							$perroom_x = "";
							if(mysqli_num_rows($resperroom) != 0){
								do{
									$perroom_x .= $rowperroom["cntperroom"].",".$rowperroom["RoomTypeID"].";";
								}while($rowperroom = mysqli_fetch_array($resperroom));
							}
							
							
						date_default_timezone_set("Asia/Manila");
						$today = date("Y-m-d");
						$days = round((strtotime($_SESSION["a_out"]) - strtotime($today))/60/60/24);
						$_SESSION["a_name"] = $rowcdid["Name"];
						?>

				<div style="width: 70%; margin: auto;">
				<form action="session_checkin.php" method="post">
				<br>
						<div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 3</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
							<center><label>Check-in Summary</label></center>
                        </div>
                      </div>
					<br>
					  <table id="example" class="table table-striped table-bordered bulk_action">
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Name: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo $_SESSION["a_name"]; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Check-in Date: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($today), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Check-out Date: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo date_format(date_create($_SESSION["a_out"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Days: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Guest(s): </b></td>
							<td style="width:70%; font-size: 15px;"><?php 
							    $_SESSION["a_guest"] = $rowcdid["Guests"];
							    
							    echo $_SESSION["a_guest"]; ?></td>
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
								$_SESSION["a_numperroom"] = $perroom_x;
								$perroom_ = $_SESSION["a_numperroom"];
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$additional = 0;
								$remguest = $_SESSION["a_guest"];
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
										$totalcap += $cap * $quantity;
										$add = $row["AdditionalPerHead"];
											$additional += ($add * $remguest);
											$remguest -= $cap * $quantity;
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
							<td style="width:30%; font-size: 15px;">Amount Paid: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" id="" style="background-color: transparent; border: 0px;" readonly value="<?php echo number_format( $totalsub - $rowcdid["RemainingBalance"], 2); ?>"></td>
						<?php
						$_SESSION["bayadna"] = $totalsub - $rowcdid["RemainingBalance"];
						?> 
						</tr>
							<tr>
							<td style="width:30%; font-size: 15px;">Remaining Balance: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" id="" style="background-color: transparent; border: 0px;" readonly value="<?php 
							    $bal_ =  $rowcdid["RemainingBalance"];
							        echo number_format($bal_, 2); ?>"></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">Additional Charges</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Additional Guest: </td>
							<?php
							    //total cap - guests
							    $extra = $_SESSION["a_guest"] - $totalcap;
							    $total_ = $totalsub + $additional;
							    $disabled = "";
								if($extra <= 0){
							        $extra = 0;
							        $disabled = "readonly";
							    }
							?>
							<td style="width:70%; font-size: 15px;">
							 <input type="text" id="extra" readonly style="background-color: transparent; border: 0px;" value="<?php echo $extra; ?>">
							</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Charge per Additional Guest: </td>
							<td style="width:70%; font-size: 15px;">
							    Php <input type="number" id="charge" style="background-color: transparent; border: 1px solid black;" <?php echo $disabled; ?> value="0">
							</td>
						</tr>
						
						<script>
						    $("#charge").on('keyup', function () {
						        var ch = parseFloat($("#charge").val());
						        if(isNaN(ch)){
						            ch = 0;
						        }
						        var g = parseFloat($("#extra").val());
						        var totalch = ch * g;
						        $("#totalcharge").val(totalch);
						        var x = <?php echo $bal_; ?>;
						        $("#total").val(totalch + x);
						    });
						</script>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Charge: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" id="totalcharge" style="background-color: transparent; border: 0px;" value="0" readonly></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Amount: </td>
							<?php
								//get maxreserve days from settings
									$settings = "SELECT * FROM settings WHERE SettingID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								$NewDate=Date('F j, Y', strtotime("+$resday days"));
							?>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" id="total" name="" style="background-color: transparent; border: 0px;"  readonly value="<?php echo $bal_; ?>"></td>
						</tr>
						
					</table>
					<br><br>
					<p style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The bill shown is <b>temporary</b> and might change due to alterations in length of stay and miscellaneous charges. Final amount to be paid will be settled on time of check-out.</p>
					<br><br>
					<button style="float:right;" type="submit" id="" name="step4" class="btn btn-primary">Next</button>
					
					<?php
					if($_SESSION["x"] != "yes"){
					?>
					
					
			 <button style="float:right;" type="" id="edit2" name="" onclick="return step2()" class="btn btn-danger">Edit Details</button>
			 
			    <?php
			        }
			    ?>
			    
			 </form>
				</div>
						
						<?php
						
						}	
						elseif(isset($_SESSION["step"])){
							$step = $_SESSION["step"];
							if($step == "5"){
				?>
				            <form action="print_receipt.php" method="post" >
					<div style="width:90%; margin: 0 auto">
					<div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 5</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:50px">
							<center><label>Payment</label></center>
                        </div>
                      </div>
					  
					  <table class="table table-hover">
									<tr>
										<td style="width:25%; font-size: 15px;"><b>Room Type</b></td>
										<td style="width:25%; font-size: 15px;"><b>Room Price</b></td>
										<td style="width:17%; font-size: 15px;"><b>Discount</b></td>
										<td style="width:16%; font-size: 15px;"><b>Disc. Amount</b></td>
									</tr>
								<?php
								$days = round((strtotime($_SESSION["a_out"]) - strtotime($today))/60/60/24);
								$perroom_ = $_SESSION["a_numperroom"];
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$additional = 0;
								$remguest = $_SESSION["a_guest"];
								$i = 0;
								foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									if($quantity != 0){
									    
									    if($quantity > 1){
									        for($j = 1; $j <= $quantity; $j++){
							            //get room price
										$price = "SELECT * FROM room_type WHERE RoomTypeID=$roomnum";
										$res = mysqli_query($conn, $price);
										$row = mysqli_fetch_array($res);
										$roomtype = $row["Description"];
										$rprice = $row["Price"];
										$sub = $rprice * $days;
										$cap = $row["Capacity"];
										$totalcap = $cap * $quantity;
										$add = $row["AdditionalPerHead"];
											$additional += ($add * $remguest);
											$remguest -= $cap * $quantity;
											//compute for additional per head
									?>
									<tr>
										<td style="font-size: 15px;"><?php echo $roomtype; ?></td>
										<td style="font-size: 15px;"><input type="number" id="<?php echo $i."n"; ?>" style="border:0px;" value="<?php echo str_replace(",", "", number_format($rprice, 2)); ?>"></td>
										<td style="font-size: 15px;"><input type="checkbox" id="<?php echo $i; ?>"></td>
										<td style="font-size: 15px;"><input type="number" id="<?php echo $i."d"; ?>" style="border:0px;" class="disc" readonly value="<?php echo str_replace(",", "", number_format($sub, 2)); ?>"></td>
									</tr>
									
									<script>
									    $('#<?php echo $i; ?>').click(function() {
                                        		  if ($('#<?php echo $i; ?>').is(':checked')) {
                                        		        var disc = parseFloat($("#<?php echo $i."n"; ?>").val()) * 0.80* <?php echo $days; ?>;
                                        		        $("#<?php echo $i."d"; ?>").val(disc.toFixed(2));
                                        		  
                                        		      total();
                                        		      
                                        		  }
                                        		  else{
                                        		       var disc = parseFloat($("#<?php echo $i."n"; ?>").val()) * <?php echo $days; ?>; 
                                        		      $("#<?php echo $i."d"; ?>").val(disc.toFixed(2));
                                        		      
                                        		      total();
                                        		  }
                                        });
									</script>
									<?php
									$totalsub += $sub;
									$i++;
									        }
									    }
									    else{
										//get room price
										$price = "SELECT * FROM room_type WHERE RoomTypeID=$roomnum";
										$res = mysqli_query($conn, $price);
										$row = mysqli_fetch_array($res);
										$roomtype = $row["Description"];
										$rprice = $row["Price"];
										$sub = $rprice * $days *$quantity;
										$cap = $row["Capacity"];
										$totalcap = $cap * $quantity;
										$add = $row["AdditionalPerHead"];
											$additional += ($add * $remguest);
											$remguest -= $cap * $quantity;
											//compute for additional per head
									?>
									<tr>
										<td style="font-size: 15px;"><?php echo $roomtype; ?></td>
										<td style="font-size: 15px;"><input type="number" id="<?php echo $i."n"; ?>" style="border:0px;" value="<?php echo str_replace(",", "", number_format($rprice, 2)); ?>" readonly></td>
										<td style="font-size: 15px;"><input type="checkbox" id="<?php echo $i; ?>"></td>
										<td style="font-size: 15px;"><input type="number" id="<?php echo $i."d"; ?>" style="border:0px;" class="disc" readonly value="<?php echo str_replace(",", "", number_format($sub, 2));?>" readonly></td>
									</tr>
									
									<script>
									    $('#<?php echo $i; ?>').click(function() {
                                        		  if ($('#<?php echo $i; ?>').is(':checked')) {
                                        		        var disc = parseFloat($("#<?php echo $i."n"; ?>").val()) * 0.80* <?php echo $days; ?>;
                                        		        $("#<?php echo $i."d"; ?>").val(disc.toFixed(2));
                                        		  
                                        		      total();
                                        		      
                                        		  }
                                        		  else{
                                        		       var disc = parseFloat($("#<?php echo $i."n"; ?>").val()) * <?php echo $days; ?>;
                                        		      $("#<?php echo $i."d"; ?>").val(disc.toFixed(2));
                                        		      
                                        		      total();
                                        		  }
                                        });
									</script>
									<?php
									$totalsub += $sub;
									$i++;
									}
									}
								}
								?>
								</table>
					<?php
					  session_start();
					  if(isset($_SESSION["total"])){
					      $total = $_SESSION["total"];
					  }
					  else{
					      $total = 0;
					  }
					  
					  if(isset($_SESSION["bayadna"])){
					    ?> 
					      <script>
								    
								    function total(){
								        var sum = 0;
                                        $('.disc').each(function(){
                                            sum += parseFloat(this.value);
                                        });
                                        
                                        var paid = <?php echo $_SESSION["bayadna"]; ?>;
                                        
                                        var sum1 = (sum + <?php echo $total; ?>) - paid;
                                        
                                        $("#t").val(sum.toFixed(2));
                                        
                                        if(sum1 < 0){
                                            sum1 = 0;
                                        }
                                        
                                        $("#topay").val(sum1.toFixed(2));
								        $("#paid").attr("min", sum1);
								    }
					</script>
					  <?php
					  }
					  else{
					  ?>
								<script>
								    
								    function total(){
								        var sum = 0;
                                        $('.disc').each(function(){
                                            sum += parseFloat(this.value);
                                        });
                                        
                                        var sum1 = (sum + <?php echo $total; ?>);
                                        $("#t").val(sum.toFixed(2));
                                        
                                        if(sum1 < 0){
                                            sum1 = 0;
                                        }
                                        
                                        $("#topay").val(sum1.toFixed(2));
								        $("#paid").attr("min", sum1);
								    }
					</script>
					<?php
					 }
					?>
					<div style="height:40px; clear:both">
					    &nbsp;
					</div>
					<center>
				<div class="form-group" style="width:30%;">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Total Room Fee:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="text" class="form-control" id="t" value="<?php echo $totalsub; ?>" name="rfee" maxlength="50" readonly required>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Extra Charge:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="text" class="form-control" id="t" value="<?php echo $total; ?>"  maxlength="50" readonly required>
                        </div>
                        <?php
                        if(isset($_SESSION["bayadna"])){
                        ?>
                         <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Amount Already Paid:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="number" name="" class="form-control" id="bayadna" value="<?php echo $_SESSION["bayadna"]; ?>" readonly required>
                        </div>  
                        <?php
                        }
                        ?>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Total Amt to Pay:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="number" name="disc" class="form-control" id="topay" value="<?php 
						  if(isset($_SESSION["bayadna"])){
						      $x = ($total+$totalsub) - $_SESSION["bayadna"];
						      if($x < 0){
						          $x = 0;
						      }
						      echo $x; 
						  }
						  else{
						      $x = $total+$totalsub; 
						   if($x < 0){
						          $x = 0;
						      }
						      echo $x; 
						  }
						  ?>" readonly required>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Amount Rendered:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="number" class="form-control" id="paid" name="paid" required max="1000000">
                        </div>
                      </div>
                      </center>
                      <script>
                          var valTo = parseFloat($("#topay").val());
								    $("#paid").attr("min", valTo);
								    
                      </script>
				
        <div style="clear:both; height:20px"></div>
			<button style="float:right;" type="submit" name="next" class="btn btn-success">Submit</button>
        </div>
		</form>
				<?php
							}
							elseif($step == "2"){
				
				?>
					<form action="" method="post" >
					<div style="width:100%;">
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
				date_default_timezone_set("Asia/Manila");
				$today = date("Y-m-d");
	
				$in__ = $today;
				$out__ = $_SESSION["a_out"];
				
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
					<h5 style="font-weight:bold">Available Rooms: <span style="font-weight:normal"><input type="text" id="<?php echo $rowroom["RoomTypeID"]."av"; ?>" readonly style="width:40px; background-color: transparent; border: 0px; text-align: center" value="<?php echo $cnt; ?>"></span></h5>
						<h5 style="font-weight:bold">Description: </h5><p><i><?php echo $rowroom["AboutRoom"]; ?></i></p>
						</div>
						</td>
						<th><center>
						    <select class="quan" style="width:70%; text-align: right" id="<?php echo $rowroom["RoomTypeID"]."nr"; ?>">
                                  <?php
                                  for($i = 0; $i <= $cnt; $i++){
                                ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                  }
                                  ?>
                              </select>
						</center></th>
							<input id="<?php echo $rowroom["RoomTypeID"]."cap"; ?>" type="number" class="totalcap" value="0" hidden>
							<input id="<?php echo $rowroom["RoomTypeID"]."ses"; ?>" type="text" class="forsess" value="0,<?php echo $rowroom["RoomTypeID"]; ?>" hidden>
						</tr>
				
				 <script>
					$("#<?php echo $rowroom["RoomTypeID"]; ?>nr").change(function() {
						
						var totalcap = parseInt($("#<?php echo $rowroom["RoomTypeID"]; ?>nr").val()) * parseInt($("#<?php echo $rowroom["RoomTypeID"]; ?>c").val());
						
						var valOfRm = $("#<?php echo $rowroom["RoomTypeID"]; ?>nr").val();
						$("#<?php echo $rowroom["RoomTypeID"]; ?>cap").val(totalcap);
						$("#<?php echo $rowroom["RoomTypeID"]; ?>ses").val(valOfRm+","+<?php echo $rowroom["RoomTypeID"]; ?>);
						
					});
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
			<button style="float:right;" onclick="return validate()" type="submit" id="next" name="next" class="btn btn-primary">Next</button>
			 <button style="float:right;" type="" id="edit" name="" onclick="return step()" class="btn btn-danger">Edit Details</button>
        </div>
		</form>
						<?php
							}
					elseif($_SESSION["step"] == "1"){
						?>
						
						<div style="width:40%; margin:auto">
							 <form action="session_checkin.php" method="post">
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
							<label>Name:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="text" class="form-control" name="name" placeholder="Guest Name" pattern=".+?(?:[\s'].+?){1,}" title="Name should contain atleast your first name and last name." maxlength="50" required>
                        </div>
                      </div>
					  
					  
							<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Check-out Date:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="date" class="form-control" id="txtDate" id="out" name="out" required>
                        </div>
                      </div>
					  
						<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Guest:</label>
                        </div>
						 <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom:50px">
						    <?php
			    
			    //get max from DB
			    $sqlset = "SELECT `MaxGuest` FROM `settings` WHERE SettingsID=1";
			    $resset = mysqli_query($conn, $sqlset);
			    $rowset = mysqli_fetch_array($resset);
			    ?>
						     
						  <input type="number" min="1" max="<?php echo $rowset["MaxGuest"]; ?>" class="form-control" id="guest" name="guest" required>
                        </div>
                      </div>
					  
					  <button style="float:right; clear:both;" type="submit" id="submitSN" name="submit" class="btn btn-success">Submit</button>
					  </form>
						</div>
						
<script>

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
	
	$('#txtDate').attr('min', tomorrow);
	$('#txtDate').val(tomorrow);
});
</script>

						
					<?php
						}elseif($_SESSION["step"] == "4"){
						?>
						
						<div style="width:100%; margin:auto">
						<form id="chk" action="chkin_process.php" method="post">
							 <div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 4</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
							<center><label>Assign Room</label></center>
                        </div>
                      </div>
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
							$perroom_ = $_SESSION["a_numperroom"];
							$perroom = rtrim($perroom_, ';');
							$message = "";
							$arrayvar = explode(";",$perroom);
							foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									$rmselected = "";
									
									//get room Description
									$getrmdesc = "SELECT * FROM room_type WHERE RoomTypeID=$roomnum";
									$resrmdesc = mysqli_query($conn, $getrmdesc);
									$rowrmdesc = mysqli_fetch_array($resrmdesc);
									$desc = $rowrmdesc["Description"];
									if($quantity != 0){
										$message .= $quantity." ".$desc.", ";
									}
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
							 <table id="example" class="table table-striped table-bordered bulk_action">
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
							    <tr>
							     <td colspan="2"><center><?php echo $rowind["AdditionalDescription"]; ?></center></td>
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
						<br><br>
						<input type="text" id="mess_" value="<?php 
						$messy = rtrim($message, ', ');
						echo $messy; ?>" hidden readonly>
						<input type="text" name="roomselected" value="<?php echo $perroom_; ?>" hidden readonly>
						<button style="float:right;" type="submit" id="cnf" name="checkin" onclick="return wait()" class="btn btn-primary" disabled>Check-in</button>
						
							<?php
					if($_SESSION["x"] != "yes"){
					?>
					
					
						<button style="float:right;" id="edit1" name="" onclick="return step1()" class="btn btn-danger">Edit Details</button>
						
						    <?php
					}
						    ?>
						
						</form>
						</div>
						<script>
							var mess = $("#mess_").val();
							swal("Selected Rooms", mess, "warning");
						</script>
						
					<?php
						}
						elseif($_SESSION["step"] == "3"){
							
						date_default_timezone_set("Asia/Manila");
						$today = date("Y-m-d");
						$days = round((strtotime($_SESSION["a_out"]) - strtotime($today))/60/60/24);
						?>

				<div style="width: 70%; margin: auto;">
				<form action="session_checkin.php" method="post">
				<br>
						<div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 3</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
							<center><label>Check-in Summary</label></center>
                        </div>
                      </div>
					<br>
					<table class="table table-hover">
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Name: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo $_SESSION["a_name"]; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Check-in Date: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($today), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Check-out Date: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo date_format(date_create($_SESSION["a_out"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Days: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Guest(s): </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $_SESSION["a_guest"]; ?></td>
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
								$perroom_ = $_SESSION["a_numperroom"];
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$additional = 0;
								$remguest = $_SESSION["a_guest"];
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
										$totalcap += $cap * $quantity;
										$add = $row["AdditionalPerHead"];
											$additional += ($add * $remguest);
											$remguest -= $cap * $quantity;
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
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">Additional Charges</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
							<tr>
							<td style="width:30%; font-size: 15px;">Additional Guest: </td>
							<?php
							    //total cap - guests
							    $extra = $_SESSION["a_guest"] - $totalcap;
							    $total_ = $totalsub + $additional;
							    $disabled = "";
								if($extra < 0){
							        $extra = 0;
							        $disabled = "readonly";
							    }
							?>
							<td style="width:70%; font-size: 15px;">
							 <input type="text" id="extra" readonly style="background-color: transparent; border: 0px;" value="<?php echo $extra; ?>">
							</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Charge per Additional Guest: </td>
							<td style="width:70%; font-size: 15px;">
							    Php <input type="number" id="charge" style="background-color: transparent; border: 1px solid black;" value="0" <?php echo $disabled; ?>>
							</td>
						</tr>
						
						<script>
						    $("#charge").on('keyup', function () {
						        var ch = parseFloat($("#charge").val());
						        if(isNaN(ch)){
						            ch = 0;
						        }
						        var g = parseFloat($("#extra").val());
						        var totalch = ch * g;
						        $("#totalcharge").val(totalch);
						        var x = <?php echo $total_; ?>;
						        $("#total").val(totalch + x)
						    });
						</script>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Charge: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" name="xtotal" id="totalcharge" style="background-color: transparent; border: 0px;" value="0" readonly></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Amount: </td>
							<?php
								//get maxreserve days from settings
									$settings = "SELECT * FROM settings WHERE SettingID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								$NewDate=Date('F j, Y', strtotime("+$resday days"));
							?>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <input type="text" id="total"  style="background-color: transparent; border: 0px;"  readonly value="<?php echo $total_; ?>"></td>
						</tr>
						
					</table>
					<br><br>
					<p style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The bill shown is <b>temporary</b> and might change due to alterations in length of stay and miscellaneous charges. Final amount to be paid will be settled on time of check-out.</p>
					<br><br>
					<button style="float:right;" type="submit" id="" name="step4" class="btn btn-primary">Next</button>
			 <button style="float:right;" type="" id="edit2" name="" onclick="return step2()" class="btn btn-danger">Edit Details</button>
			 </form>
				</div>
						
						<?php
						}
						}
						else{
						?>
						
						<div style="width:40%; margin:auto">
							 <form action="session_checkin.php" method="post">
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
							<label>Name:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="text" class="form-control" name="name" placeholder="Guest Name" maxlength="50" required>
                        </div>
                      </div>
					  
					  
							<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Check-out Date:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="date" class="form-control" id="txtDate" name="out" required>
                        </div>
                      </div>
					  
						<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Guest:</label>
                        </div>
						 <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom:50px">
						  <input type="number" min="1" max="1000" class="form-control" name="guest" required>
                        </div>
                      </div>
					  
					  <button style="float:right; clear:both;" type="submit" id="submitSN" name="submit" class="btn btn-success">Submit</button>
					  </form>
						</div>
						
					<?php
						}
					?>
                  </div>
				
				
                </div>
				
              </div>
		
		<div style="clear:both;">
		</div>
		</div>
		
		<!-- /page content -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
		<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]]
    } );
} );

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

$('.checkbox').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){
			  $("#cnf").prop("disabled", false);
		  }else{
			  $("#cnf").prop("disabled", true);
		  }
});

function step(){
	
	swal({
  title: "Are you sure?",
  text: "You are about to edit your reservation. Current reservation details will be deleted.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes!",
  closeOnConfirm: false
},
function(){
  $.ajax({
		url: "step_one.php",
		method: "post",
		success: function(){
			window.location.href="walk_checkin.php";
		}
	});
});
	
	return false;
}

function step2(){
	
	swal({
  title: "Are you sure?",
  text: "You are about to edit your reservation. Current reservation details will be deleted.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes!",
  closeOnConfirm: false
},
function(){
  $.ajax({
		url: "step_one.php",
		method: "post",
		success: function(){
			window.location.href="walk_checkin.php";
		}
	});
});
	
	return false;
}

function step1(){
	
	swal({
  title: "Are you sure?",
  text: "You are about to edit your reservation. Current reservation details will be deleted.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes!",
  closeOnConfirm: false
},
function(){
  $.ajax({
		url: "step_one.php",
		method: "post",
		success: function(){
			window.location.href="walk_checkin.php";
		}
	});
});
	
	return false;
}
		
 
function validate(){
	//check if there is a room selected.
	//check if it does not exceed max room.
	
	var sum = 0;
	var mess = "";
	var submess = "";
	
	var sumcap = 0;
	var guest = <?php
		echo $_SESSION["a_guest"];
	?>;
	
	$('.quan').each(function(){
         sum += parseInt($(this).val());
    });
	
	$('.totalcap').each(function(){
         	if ($(this).val() != "") {
			sumcap += parseInt($(this).val());
		}
	});
	
	
	if(sum == 0){
		mess = "No room selected yet!";
		submess = "There must be atleast 1 room selected";
		swal(mess, submess, "warning");
		return false;
	}
	else if(sumcap < guest){
		swal({
  title: "Capacity Validation",
  text: "The number of guests exceeds the actual room capacity. This is possible but additional payment will be charged upon check-out! Do you want to proceed?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, proceed!",
  closeOnConfirm: false
},
function(){
  //redirect page;
 var numperroom = "";
			$(".forsess").each(function() {
				numperroom += $(this).val() + ";";
			});
			
		//for sessions
		$.ajax({
			url: "session_checkin.php",
			method: "post",
			data: {
				numperroom_post : numperroom
			},
			success: function(){
				window.location.href="walk_checkin.php";
			}
		});
		
});
  return false;
	}
	else{
	
			var numperroom = "";
			$(".forsess").each(function() {
				numperroom += $(this).val() + ";";
			});
			
		//for sessions
		$.ajax({
			url: "session_checkin.php",
			method: "post",
			data: {
				numperroom_post : numperroom
			},
			success: function(){
				return true;
			}
		});
		
	}
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

		</script>
				<!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:40%">
                      <div class="modal-content">
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="upload_abstract.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Book Details</h4>
                        </div>
                        <div class="modal-body">
                
						<div id="result"></div>
					
                	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="upload" class="btn btn-success">Save changes</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
		
