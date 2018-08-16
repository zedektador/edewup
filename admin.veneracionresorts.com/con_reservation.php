<?php
include("weblock.php");
?>
		<!-- page content -->
        <div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
			
				<center><h2 style="font-size:30px">Reservation (Walk-in)</h2></center>
				
						<?php
					  if(isset($_GET["mess"])){
						?>
				  <div class="
				  <?php 
				  if($_GET["mess"] == "Reservation slip successfully sent to your email")
				  {
					  echo "alert alert-success alert-dismissible fade in";
				  }
				  else{
					  echo "alert alert-success alert-dismissible fade in";
				  }
				  ?>
				  " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["mess"]; ?></strong></center>
                  </div>
				  <script>
						history.pushState(null, '', '/reservation.php');
				  </script>
					  <?php
					  }
					  ?>
				
				<div class="x_panel">
                  <div class="x_content">
						<?php
						if(isset($_SESSION["wi_step"])){
							$step = $_SESSION["wi_step"];
							if($step == "2"){
				
				?>
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
				$out__ = $_SESSION["wi_out"];
				
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
						<th><center><select class="quan" style="width:70%; text-align: right" id="<?php echo $rowroom["RoomTypeID"]."nr"; ?>">
                                  <?php
                                  for($i = 0; $i <= $cnt; $i++){
                                ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                  }
                                  ?>
                              </select></center></th>
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
						<?php
							}
					elseif($_SESSION["wi_step"] == "3"){
						?>
						
						<div style="width:100%; margin:auto">
						<div class="col-md-12 col-sm-9 col-xs-12">
							<center><label style="font-weight:bold; font-size:20px">STEP 3</label></center>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
							<center><label>Fill-up Form</label>
							</center>
                        </div>
                      </div>
					  
					  <div style="margin:auto; width:80%;">
				 <form id="reg" onsubmit="return isValidForm()" name="account" id="login-form" action="">
                <div class="row">
				<center>
				<table style="width:60%">
					<tr>
					<td><h5 class="section-heading">Full Name</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="fullname" id="name" class="form-control" type="text" pattern=".+?(?:[\s'].+?){1,}" title="Name should contain atleast your first name and last name." placeholder="Client Name" required maxlength="70"></td>
					</tr>
					<tr>
					<td><h5 class="section-heading">Address</h5></td>
					</tr>
					<tr style="height:20px">
					<td><textarea rows="3" style="width:100%" name="address" id="address" class="form-control" placeholder="Address" required maxlength="120"></textarea></td>
					</tr>
					<tr>
					<td><h5 class="section-heading">E-mail<span style="" id="emnotif"></span></h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="email" id="email" class="form-control" type="text" placeholder="E-mail Address" required maxlength="70"></td>
					</tr>
					<tr>
					<td><h5 class="section-heading">Phone Number</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="cnum" id="phone" class="form-control" type="text"  pattern="[0-9]{11}" title="Follow the format: 09XXXXXXXXX." placeholder="Contact Number" required maxlength="11"></td>
					</tr>
				</table>
				</center>
            </div>
            <br><br>
				<center>
				<button type="" id="edit2" name="" onclick="return step1()" class="btn btn-danger">Edit Reservation Details</button>
				<button id="new" type="submit" class="btn btn-success">Confirm Booking</button>
				</center>
				</form>
				<br><br>
                  </div>
						
					<?php
						}
						elseif($_SESSION["wi_step"] == "4"){
							
						date_default_timezone_set("Asia/Manila");
						$today = date("Y-m-d");
						$days = round((strtotime($_SESSION["wi_out"]) - strtotime($_SESSION["wi_in"]))/60/60/24);
						
						if(isset($_GET["new"])){
						?>
							<script>
								swal("Success", "Client account successfully created!", "success");
								history.pushState(null, '', '/reservation.php');
							</script>
						<?php
						}
						
						
						?>
						
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
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Name: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo $_SESSION["wi_name"]; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;"><b>Check-in Date: </b></td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($_SESSION["wi_in"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Check-out Date: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo date_format(date_create($_SESSION["wi_out"]), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Days: </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;"><b>Guest(s): </b></td>
							<td style="width:70%; font-size: 15px;"><?php echo $_SESSION["wi_guest"]; ?></td>
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
								$perroom_ = $_SESSION["wi_numperroom"];
								$perroom = rtrim($perroom_, ';');
								$arrayvar = explode(";",$perroom);
								$totalsub = 0;
								$additional = 0;
								$matt = 0;
								$remguest = $_SESSION["wi_guest"];
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
											//compute for additional per head
									    $totalcap += $cap * $quantity;
									    $matt += 2 * $quantity;
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
						    $number = $_SESSION["wi_guest"];
						    $total_ = $totalsub + $additional;
							$ex = $number - $totalcap;
							if($matt < $ex){
							 ?>
							 <script>
                            		swal({
                                            title: "Room Cap Validation!",
                                            text: "We can't accommodate the given number of guests even with the inclusion of 2 mattresses per room selected. <?php echo $ex-$matt; ?> excess guests.",
                                            type: "warning",
                                            confirmButtonClass: "btn-danger",
                                          confirmButtonText: "Ok!",
                                          closeOnConfirm: false
                                        }, function() {
                                            window.location = "backto2.php";
                                            //change this
                                            /*
                                                -back to step 2, do not pass thru step 3, go to step 4
                                            */
                                        });
                            </script>
                            <?php
							}
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
							    <input type="number" name="mat" style="width:70%; border:0px " id="mat" min="1" readonly max="100" value="<?php echo $ex; ?>">
							</td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">Additional Charges:</td>
							<td style="width:50%; font-size: 15px;">Php&nbsp; 
							    <input type="text" style="border:0px; width:50%" id="add" readonly value="<?php echo number_format($prmat * $ex, 2); ?>">
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
						        $("#total").val(tot);
						        $("#newbal").val(newbal);
						    });
						</script>
						<?php
							}
							else{
						?>
						        <input type="number" name="mat" style="width:50%" id="mat" max="100" hidden value="0">
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
							 echo str_replace(",", "", number_format(($total_ + ($prmat*$ex))/1.12, 2)); ?>"></td>
						</tr>
						<tr>
							<td style="width:50%; font-size: 15px;">VAT (12%):</td>
							<td style="width:50%; font-size: 15px;">
							       Php&nbsp;<input type="number" style="border:0px; width:50%" id="vatx" readonly value="<?php 
							 echo str_replace(",", "", number_format((($total_ + ($prmat*$ex))/1.12)*0.12, 2)); ?>">
							</td>
						</tr>
						
						<tr>
							<td style="width:50%; font-size: 15px;">Total Amount:</td>
							<td style="width:50%; font-size: 15px; font-weight: bold" >
							    Php&nbsp;<input type="number" name="total" style="border:0px; width:50%" id="total" readonly value="<?php 
							 echo str_replace(",", "", number_format($total_ + ($prmat*$ex), 2)); ?>">
							</td>
						</tr>
						<tr>
						    <?php
								$total_ = $totalsub + $additional;
								//get maxreserve days from settings
									$settings = "SELECT * FROM settings WHERE SettingID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								$NewDate=Date('F j, Y', strtotime("+$resday days"));
							?>
							<td style="width:30%; font-size: 15px;">Deadline of Downpayment: </td>
							
							<?php
								//get maxreserve days from settings
								    
									$settings = "SELECT * FROM settings WHERE SettingsID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								$NewDate=Date('F j, Y', strtotime("+$resday days"));
							?>
							
							<td style="width:70%; font-size: 15px; font-weight: bold"><?php echo $NewDate; ?></td>
						</tr>
					</table>
					<br><br><br>
					<center><h4 style="font-weight: bold">A link will be sent to your email. Please click the link to print reservation slip.</h4></center>
					<?php
						$settings = "SELECT * FROM settings WHERE SettingID=1";
						$resset = mysqli_query($conn, $settings);
						$rowset = mysqli_fetch_array($resset);
					?>
					<br><br>
					<center>
			<button type="" id="edit2" name="" onclick="return step2()" class="btn btn-danger">Edit Reservation Details</button>
					<button id="confirm" class="btn btn-success">Confirm Reservation
			 </center>
			 </div>
						<br><br>
						<?php
						}
						}
						
						else{
						?>
						
						
						
						
						<div style="width:40%; margin:auto">
							 <form action="session_checkin_wi.php" method="post">
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
						  <input type="date" class="form-control" id="txtDate" name="in" onchange="updDate()" required>
                        </div>
                      </div>
					  
					  
							<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Check-out Date:</label>
                        </div>
						 <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px">
						  <input type="date" class="form-control" id="txtDateOut" name="out" required>
                        </div>
                      </div>
					  
						<div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<label>Guest:</label>
                        </div>
						 <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom:50px">
						     <?php
						     //ger max
						     $settings = mysqli_query($conn, "SELECT * FROM settings WHERE SettingsID=1");
						     $rowset = mysqli_fetch_array($settings);
						     $max = $rowset["MaxGuest"];
						     ?>
						  <input type="number" class="form-control" min="1" max="<?php echo $max; ?>" name="guest" required>
                        </div>
                      </div>
					  
					  <button style="float:right; clear:both;" type="submit" id="submitSN" name="submit" class="btn btn-primary">Submit</button>
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
		

$("#confirm").click(function () {
	var total = $("#total").val();
	var mat = $("#mat").val();
	window.location.href="save_reservation.php?total="+total+"&mat="+mat;
});
	
$("#print").click(function () {
	var total = $("#total").val();
	
	window.location.href="print_resSlip.php?total="+total;
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

$('.checkbox').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){
			  $("#cnf").prop("disabled", false);
		  }else{
			  $("#cnf").prop("disabled", true);
		  }
});

function openModal(){
				$('#modal').modal('show');
			}
			
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
		data: {
			from_: "wi" 
		},
		success: function(){
			window.location.href="reservation.php";
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
		data: {
			from_: "wi" 
		},
		success: function(){
			window.location.href="reservation.php";
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
		data: {
			from_: "wi" 
		},
		success: function(){
			window.location.href="reservation.php";
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
		echo $_SESSION["wi_guest"];
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
	/*
	else if(sumcap < guest){
		mess = "The rooms 18 accommodate number of guest.";
		submess = "Check room capacity."
		swal(mess, submess, "warning");
		return false;
	}
	*/
	else{
		
			var numperroom = "";
			$(".forsess").each(function() {
				numperroom += $(this).val() + ";";
			});
			
		//for sessions
		$.ajax({
			url: "session_checkin_wi.php",
			method: "post",
			data: {
				numperroom_post : numperroom
			},
			success: function(){
				window.location.href="reservation.php";
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
		<script>
		
		$("#email").keyup(function (){
					var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					var res = re.test($("#email").val());
					if(res == false){
						$("#email").attr("style", "border: 1px solid red");
						$("#emnotif").attr("style", "color:red;font-size:10px;");
						$("#emnotif").html("&nbsp;&nbsp;&nbsp;Invalid email");
					}
					else{
						$("#email").attr("style", "border: 1px solid green");
						$("#emnotif").attr("style", "color:green;font-size:10px;");
						$("#emnotif").html("&nbsp;&nbsp;&nbsp;Valid email");
					}
		});
		
		
		function isValidForm(){
				//check validations
					//email
					var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					var res = re.test($("#email").val());
					if(res == false){
						swal("Validation", "The email you inputted is invalid.", "warning");
						$("#email").val("");
						$("#email").attr("style", "border: 1px solid red");
						return res;
					}
					else{
				//ajax here
				//save all input to database and proceed to account.php
				var name = $("#name").val();
				var address = $("#address").val();
				var email = $("#email").val();
				var phone = $("#phone").val();
				
				$.ajax({
					url: "save_accountRecord.php",
					method: "post",
					data: {
						name_post:name,
						address_post:address,
						email_post:email,
						phone_post:phone
						},
					success: function(result){
						if(result == "Successful"){
							window.location.href="reservation.php?new";
						}
						else{
							swal("Validation", result, "warning");
						}
					}
				});
				
				return false;
			}
					
		}
		
		
	</script>
				
