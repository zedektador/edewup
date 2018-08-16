<style type="text/css">
    input[id=mattress]::-webkit-inner-spin-button, 
input[id=mattress]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>

<?php
include("weblock.php");
if(isset($_POST["prc4"])){
	$ctotal = $_POST["ctotal"];
	$other = $_POST["other"];
	$finalbill = $ctotal - $other;
	if($finalbill < 0){
		$finalbill = 0;
	}
	
	$id = $_POST["idchkin"];
		//get details
			//name
			$det = "SELECT * FROM 
			in JOIN reservation ON checkin.ReservationID=reservation.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE checkin.CheckinID=$id";
			$resdet = mysqli_query($conn, $det);
			if(mysqli_num_rows($resdet) != 0){ //get from reservation table
				$rowdet = mysqli_fetch_array($resdet);
					$client = $rowdet["Name"];
			}
			else{ //get from walkin
				$det = "SELECT * from checkin JOIN walkin ON checkin.WalkinID=walkin.WalkinID WHERE checkin.CheckinID=$id";
				$resdet = mysqli_query($conn, $det);
				$rowdet = mysqli_fetch_array($resdet);
			    	$client = $rowdet["ClientName"];
			    
			}
			$in = date_format(date_create($rowdet["CheckinDateTime"]), "F j, Y");
			date_default_timezone_set("Asia/Manila");
			$out = date("F j, Y h:i a");
?> 
	
	<div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
				
			
				<center><h2 style="font-size:30px">Check-out Bill</h2></center>
				
				<div class="x_panel">
				
				<div style="margin:auto; width:80%;">
				
					<div class="row">
					<form action="payment.php" method="post" onsubmit="return validate()">
				<center>
				<table style="width:60%">
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Full Name</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="fullname" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70" value="<?php echo $client; ?>" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Check-in Date</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="in" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo $in; ?>" required maxlength="70" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Date Today: </h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="out" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70"  value="<?php echo $out; ?>" readonly></td>
					</tr>
					
					
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Vatable Amount: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="ctotal" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo "Php ".number_format(($finalbill/1.12),2); ?>" required maxlength="70" readonly>
					
					<input style="width:50%" name="idlast" type="text" value="<?php echo $id; ?>" hidden>
					</center></td>
					</tr>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">VAT(12%): </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="other" id="othdec" class="form-control" type="text" value="<?php echo "Php ".number_format(($finalbill/1.12) * 0.12,2); ?>" readonly></center></td>
					</tr>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Total Amount to Pay: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="" id="othdec" class="form-control" type="text" value="<?php echo "Php ".number_format($finalbill,2); ?>" readonly>
					
					<input style="width:50%" name="totalnatalaga" id=""  type="text" value="<?php echo $finalbill; ?>" readonly hidden>
					</center></td>
					</tr>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Amount Rendered: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="rendered" id="ren" class="form-control" type="number" step="any" max="1000000" min="0" required></center></td>
					</tr>
					
				</table>
				</center>
				<br>
				<button id="proceed4" name="prc4" type="submit" style="float:right" class="btn btn-success">Proceed</button>
				</form>
            </div>
				</div>
                  <div class="x_content">
				  </div>
				 </div>
				 </div>
				 
          <div class="clearfix"></div>
		  
				 </div>
	
<?php
}
elseif(isset($_GET["cbill"])){
	$id = $_GET["id"];
		//get details
			//name
			$det = "SELECT * FROM checkin JOIN reservation ON checkin.ReservationID=reservation.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE checkin.CheckinID=$id";
			$resdet = mysqli_query($conn, $det);
			if(mysqli_num_rows($resdet) != 0){ //get from reservation table
				$rowdet = mysqli_fetch_array($resdet);
			$client = $rowdet["Name"];
			}
			else{ //get from walkin
				$det = "SELECT * from checkin JOIN walkin ON checkin.WalkinID=walkin.WalkinID WHERE checkin.CheckinID=$id";
				$resdet = mysqli_query($conn, $det);
				$rowdet = mysqli_fetch_array($resdet);
			$client = $rowdet["ClientName"];
			}
			$in = date_format(date_create($rowdet["CheckinDateTime"]), "F j, Y");
			date_default_timezone_set("Asia/Manila");
			$out = date("F j, Y h:i a");
?>
		
	<div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
				
			
				<center><h2 style="font-size:30px">Check-out Bill</h2></center>
				
				<div class="x_panel">
				
				<div style="margin:auto; width:80%;">
				
					<div class="row">
					<form action="directory.php" method="post">
				<center>
				<table style="width:60%">
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Full Name</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="fullname" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70" value="<?php echo $client; ?>" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Check-in Date</h5></td>
					</tr>
					<tr style="height:20px">
					<td>
					<input type="text" name="idchkin" readonly hidden value="<?php echo $_GET["id"]; ?>">
					
					<input style="width:100%" name="in" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo $in; ?>" required maxlength="70" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Date Today: </h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="out" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70"  value="<?php echo $out; ?>" readonly></td>
					</tr>
					
					
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Total Bill: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="" class="form-control" value="<?php echo "Php ".number_format($_GET["cbill"],2); ?>" required readonly></center></td>
					</tr>
					
					<?php
					$idxx = $_GET["id"];
					$bill = $_GET["cbill"];
					//get amount paid
					    
					    //reserved
					    $resel = "SELECT * FROM checkin JOIN reservation ON checkin.ReservationID=reservation.ReservationID WHERE checkin.CheckinID=$idxx";
					    $ressel = mysqli_query($conn, $resel);
					    if(mysqli_num_rows($ressel) != 0){
					        $rowsel = mysqli_fetch_array($ressel);
					        $p = $rowsel["TotalBill"];
					        $b = $bill - $p;
					        if($b < 0){
					            $b = 0;
					        }
					    }
					    else{ 
					    //walkin
					        session_start();
					    
					        $wsel = "SELECT * FROM checkin JOIN walkin ON checkin.WalkinID=walkin.WalkinID WHERE checkin.CheckinID=$idxx";
					        $resw = mysqli_query($conn, $wsel);
					        $roww = mysqli_fetch_array($resw);
					        $p = $_SESSION["witotal"];
					        $b = $bill - $p;
					        if($b < 0){
					            $b = 0;
					        }      
					    }
					   
					?>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Amount Already Paid: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="" value="<?php echo "Php ".number_format($p,2); ?>" id="" class="form-control" required readonly></center></td>
					</tr>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Final Bill: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center>
					    
					    <input style="width:50%" name="" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo "Php ".number_format($b,2); ?>" required maxlength="70" readonly>
					
					<input style="width:50%" name="ctotal" id="name" type="text" placeholder="Client Name"  value="<?php echo $b; ?>" required maxlength="70" readonly hidden>
					</center></td>
					</tr>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Other Deductions: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="other" id="othdec" class="form-control" type="number" value="0.00" step="any" min="0" required max="100000"></center></td>
					</tr>
					
				</table>
				</center>
				<br>
				<button id="proceed4" name="prc4" type="submit" style="float:right" class="btn btn-success">Proceed</button>
				</form>
            </div>
				</div>
                  <div class="x_content">
				  </div>
				 </div>
				 </div>
				 
          <div class="clearfix"></div>
		  
				 </div>


<?php
}
elseif(isset($_GET["total"])){
	$id = $_GET["id"];
		//get details
			//name
			$det = "SELECT * FROM checkin JOIN reservation ON checkin.ReservationID=reservation.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE checkin.CheckinID=$id";
			$resdet = mysqli_query($conn, $det);
			if(mysqli_num_rows($resdet) != 0){ //get from reservation table
				$rowdet = mysqli_fetch_array($resdet);
			$client = $rowdet["Name"];
			}
			else{ //get from walkin
				$det = "SELECT * from checkin JOIN walkin ON checkin.WalkinID=walkin.WalkinID WHERE checkin.CheckinID=$id";
				$resdet = mysqli_query($conn, $det);
				$rowdet = mysqli_fetch_array($resdet);
			$client = $rowdet["ClientName"];
			
			    
			}
			$in = date_format(date_create($rowdet["CheckinDateTime"]), "F j, Y");
			date_default_timezone_set("Asia/Manila");
			$out = date("F j, Y h:i a");
?>
	
	<div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
				
			
				<center><h2 style="font-size:30px">Check-out Bill</h2></center>
				
				<div class="x_panel">
				
				<div style="margin:auto; width:80%;">
				
					<div class="row">
					<form id="proceed3">
				<center>
				<table style="width:60%">
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Full Name</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="fullname" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70" value="<?php echo $client; ?>" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Check-in Date</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="in" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo $in; ?>" required maxlength="70" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Date Today: </h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="out" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70"  value="<?php echo $out; ?>" readonly></td>
					</tr>
					
					
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Total Room Fee: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="in" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo "Php ".number_format($_GET["total"],2); ?>" required maxlength="70" readonly></center></td>
					</tr>
					
					
					<?php
					//get standard out
								$stout = "SELECT * FROM settings WHERE SettingID=1";
								$resout = mysqli_query($conn, $stout);
								$rowout = mysqli_fetch_array($resout);
								$standard = date_format(date_create($rowout["CheckoutTime"]), "H:i");
								$standardx = $rowout["CheckoutTime"]; 
					//number of hours extended:
									
									if(date("H:i") > $standard){ //considered
										$ext = floor((strtotime(date("Y-m-d H:i")) - strtotime(date("Y-m-d $standardx")))/60/60);
									}
									else{ //not yet
										$ext = 24 - floor((strtotime(date("Y-m-d $standardx")) - strtotime(date("Y-m-d H:i")))/60/60);
									}
									
					//get number of actual
					$actual = $_GET["act"];
					$snr = $_GET["snr"];
					$actx = $actual - $snr;
					$extfee = ($actx * 40 * $ext) + ($snr * (40 * 0.80) * $ext);
					
					//for extra 
					$extras = $_GET["extra"] - $snr;
					if($extras < 0){
						$extras = 0;
					}
					if($snr >= $_GET["extra"]){
						$snr = $_GET["extra"];
					}
					$extrafee = ($extras * 250) + ($snr * (250 * 0.80));
					
					$totalxxx = $extfee + $extrafee + $_GET["total"];
					?>
					
					<tr>
					<td><center><h5 class="section-heading" style="font-weight: bold">Damage Fee: </h5></center></td>
					</tr>
					<tr style="height:20px">
					<td><center><input style="width:50%" name="in" id="dmgfee" class="form-control" type="number" value="0.00" step="any" min="0" required max="100000"></center></td>
					</tr>
					
				</table>
				</center>
				<br>
				<button id="" name="" type="submit" style="float:right" class="btn btn-success">Proceed</button>
            </form>
			</div>
				</div>
                  <div class="x_content">
				  </div>
				 </div>
				 </div>
				 
          <div class="clearfix"></div>
		  
				 </div>
<?php
}
elseif(isset($_GET["out"])){
		$id = $_GET["out"];
		//get details
			//name
			$det = "SELECT * FROM checkin JOIN reservation ON checkin.ReservationID=reservation.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE checkin.CheckinID=$id";
			$resdet = mysqli_query($conn, $det);
			if(mysqli_num_rows($resdet) != 0){ //get from reservation table
				$rowdet = mysqli_fetch_array($resdet);
			$client = $rowdet["Name"];
			}
			else{ //get from walkin
				$det = "SELECT * from checkin JOIN walkin ON checkin.WalkinID=walkin.WalkinID WHERE checkin.CheckinID=$id";
				$resdet = mysqli_query($conn, $det);
				$rowdet = mysqli_fetch_array($resdet);
			$client = $rowdet["ClientName"];
			}
			$in = date_format(date_create($rowdet["CheckinDateTime"]), "F j, Y");
			date_default_timezone_set("Asia/Manila");
			$out = date("F j, Y h:i a");
?>
		<!-- page content -->
        <div class="right_col" role="main" style="min-height:500px">
			<div class="col-md-12 col-sm-12 col-xs-12">
				
			
				<center><h2 style="font-size:30px">Check-out Bill</h2></center>
				
				<div class="x_panel">
                  <div class="x_content">
						
						<div style="margin:auto; width:80%;">
				 <form id="reg" onsubmit="return isValidForm()" name="account" id="login-form" action="">
                <div class="row">
				<center>
				<table style="width:60%">
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Full Name</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="fullname" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70" value="<?php echo $client; ?>" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Check-in Date</h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="in" id="name" class="form-control" type="text" placeholder="Client Name"  value="<?php echo $in; ?>" required maxlength="70" readonly></td>
					</tr>
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold">Date Today: </h5></td>
					</tr>
					<tr style="height:20px">
					<td><input style="width:100%" name="out" id="name" class="form-control" type="text" placeholder="Client Name" required maxlength="70"  value="<?php echo $out; ?>" readonly></td>
					</tr>
				</table>
				</center>
            </div>
				<br>
				</form>
				<br><br>
                  </div>
				  
				  <div style="margin:auto; width:80%;">
				<div class="row">
				<center>
				<table class="table table-hover">
					<tr>
					<td><h5 class="section-heading" style="font-weight: bold; font-size: 20px;"><center>Room Fee</center></h5></td>
					</tr>
					<tr style="height:20px">
						<table class="table table-hover">
							<tr style="line-height:30px; font-weight: bold">
								<td style="width: 20%">Room Number</td>
								<td style="width: 20%">Room Price</td>
								<td style="width: 20%">From</td>
								<td style="width: 20%">To</td>
								<td style="width: 20%">Length</td>
							</tr>
							<?php
							    session_start();
								                
								//get all rooms
								$rm = "SELECT * FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE CheckinID=$id";
								$resrm = mysqli_query($conn, $rm);
								$rowrm = mysqli_fetch_array($resrm);
								$total = 0;
								$witotal = 0;
								
							                        	//get standard out
                        								$stout = "SELECT * FROM settings WHERE SettingsID=1";
                        								$resout = mysqli_query($conn, $stout);
                        								$rowout = mysqli_fetch_array($resout);
                        								$standard = date_format(date_create($rowout["StandardOut"]), "H:i");
                        								
								if(mysqli_num_rows($resrm) != 0){
									do {
								        $rn = $rowrm["RoomNumber"];
								        $pr = $rowrm["Price"];
								       
								        //check if it transferred
								        $transql = "SELECT * FROM room_transfer WHERE NewRoom='$rn' AND CheckinID=$id";
								        $restrans = mysqli_query($conn, $transql);
								        $rowtrans = mysqli_fetch_array($restrans);
								        if(mysqli_num_rows($restrans) != 0){    //transferred
								            //get date of transfer
								            $transdate = date_format(date_create($rowtrans["TransferDateTime"]), "Y-m-d");
								            //fee divided to 2
								                $beftransfer = round((strtotime($transdate) - strtotime($in))/60/60/24);
								                //get price in old room
								                $prev = $rowtrans["PreviousRoom"];
								                $priceold = "SELECT * FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE RoomNumber='$prev'";
								                $resold = mysqli_query($conn, $priceold);
								                $rowold = mysqli_fetch_array($resold);
								                $price = $rowold["Price"];
								                
								                
								            //this block is for the paid amount of walkin guests
								            //check if it is walkin
								            $wi = "SELECT * FROM checkin WHERE CheckinID=$id";
								            $reswi = mysqli_query($conn, $wi);
								            $rowwi = mysqli_fetch_array($reswi);
								            if($rowwi["WalkinID"] != NULL){//walkin sya
								                
								                $out = date_format(date_create($rowwi["CheckoutDateTime"]), "Y-m-d");
								                $actual = round((strtotime($out) - strtotime($in))/60/60/24);
								                $witotal += $actual * $price;        
								            }
								        //end of block
								        
								                
								                
								                if($beftransfer > 0){
								                    //not the same day of checkin
								                   ?>
								                    <tr>
                        								<td><?php echo $prev; ?></td>
                        								<td><?php echo number_format($price, 2); ?></td>
                        								<td><?php echo $in; ?></td>
                        								<td><?php echo date_format(date_create($transdate), "F j, Y"); ?></td>
                        								<td><?php echo $beftransfer; ?></td>
                        							</tr>
                        							<?php
                        							 $pricex = $price * ($beftransfer);
                        							 
                        							//check if nagEO
								                        $chkEO = "SELECT * FROM room WHERE RoomNumber='$rn'";
								                        $resEO = mysqli_query($conn, $chkEO);
								                        $rowEO = mysqli_fetch_array($resEO);
								                        if($rowEO["EarlyOut"] != NULL){
								                            $today = date_format(date_create($rowEO["EarlyOut"]), "F j, Y");
								                             $aftertransfer = round((strtotime($today) - strtotime($transdate))/60/60/24);
								                        }
								                        else{
								                            $today = date("F j, Y");
								                             $aftertransfer = round((strtotime($today) - strtotime($transdate))/60/60/24);
								                            if((date("H:i") > $standard) AND (strtotime($in) != strtotime($today))){ //considered
                                                				    $aftertransfer += 1;
                            									}
								                        }
								                   
								                   
								                    if($aftertransfer < 1){
								                        $aftertransfer = 1;
								                    }
								                   
								                    ?>
								                    <tr>
                        								<td><?php echo $rn; ?></td>
                        								<td><?php echo number_format($pr,2); ?></td>
                        								<td><?php echo date_format(date_create($transdate), "F j, Y"); ?></td>
                        								<td><?php echo $today; ?></td>
                        								<td><?php echo $aftertransfer; ?></td>
                        							</tr>
								                    <?php
								                                //if more than st_out: +1//
                                                				//if not: as is//
                                                				
                            						$prx = $pr * $aftertransfer;
								                    $total += $prx + $pricex;
								                }
								                else{
								                    //same day of checkin
								                        //in to date today
								                                //if more than st_out: +1
								                                //if not: as is
								                    //check if nagEO
								                        $chkEO = "SELECT * FROM room WHERE RoomNumber='$rn'";
								                        $resEO = mysqli_query($conn, $chkEO);
								                        $rowEO = mysqli_fetch_array($resEO);
								                        if($rowEO["EarlyOut"] != NULL){
								                            $today = date_format(date_create($rowEO["EarlyOut"]), "F j, Y");
								                            $aftertransfer = round((strtotime($today) - strtotime($in))/60/60/24);
								                    
								                        }
								                        else{
								                            $today = date("F j, Y");
								                            $aftertransfer = round((strtotime($today) - strtotime($in))/60/60/24);
								                    
								                            	if((date("H:i") > $standard) AND (strtotime($in) != strtotime($today))){ //considered
                                                				    $aftertransfer += 1;
                            									}
								                        }
								                    
								                    if($aftertransfer == 0){
								                        $aftertransfer = 1;
								                    }
								                    
								                    ?>
								                    <tr>
                        								<td><?php echo $rn; ?></td>
                        								<td><?php echo number_format($pr,2); ?></td>
                        								<td><?php echo $in; ?></td>
                        								<td><?php echo $today; ?></td>
                        								<td><?php echo $aftertransfer; ?></td>
                        							</tr>
								                    <?php
								                                //if more than st_out: +1//
                                                				//if not: as is//
                                                			
                            						$prx = $pr * $aftertransfer;
								                    $total += $prx;
								                }      
								        }
								        else{   //did not transfer
								            //current date - in date 
								                    
								                    //check if nagEO
								                        $chkEO = "SELECT * FROM room WHERE RoomNumber='$rn'";
								                        $resEO = mysqli_query($conn, $chkEO);
								                        $rowEO = mysqli_fetch_array($resEO);
								                        if($rowEO["EarlyOut"] != NULL){
								                            $today = date_format(date_create($rowEO["EarlyOut"]), "F j, Y");
								                          $aftertransfer = round((strtotime($today) - strtotime($in))/60/60/24);
								                  }
								                        else{
								                            $today = date("F j, Y");
								                            $aftertransfer = round((strtotime($today) - strtotime($in))/60/60/24);
								                  
								                            if((date("H:i") > $standard) AND (strtotime($in) != strtotime($today))){ //considered
                                                				    $aftertransfer += 1;
                            									}
								                        }
								                        
								                    
								        //this block is for the paid amount of walkin guests
								            //check if it is walkin
								            $wi = "SELECT * FROM checkin WHERE CheckinID=$id";
								            $reswi = mysqli_query($conn, $wi);
								            $rowwi = mysqli_fetch_array($reswi);
								            if($rowwi["WalkinID"] != NULL){//walkin sya
								                
								                $out = date_format(date_create($rowwi["CheckoutDateTime"]), "Y-m-d");
								                $actual = round((strtotime($out) - strtotime($in))/60/60/24);
								                $witotal += $actual * $pr;        
								            }
								        //end of block
								                    
								                    ?>
								                    <tr>
                        								<td><?php echo $rn; ?></td>
                        								<td><?php echo number_format($pr,2); ?></td>
                        								<td><?php echo $in; ?></td>
                        								<td><?php echo $today; ?></td>
                        								<td><?php 
                        						    if($aftertransfer == 0){
								                        $aftertransfer = 1;
								                    }
                        								    echo $aftertransfer; ?></td>
                        							</tr>
								                    <?php
								                                //if more than st_out: +1//
                                                				//if not: as is//
                                                			
                            						$prx = $pr * $aftertransfer;
								                    $total += $prx;
								        }
									}while($rowrm = mysqli_fetch_array($resrm));
									
									                
												    if((date("H:i") > $standard) AND (strtotime($in) != strtotime($today))){ //considered
                                                	?>
                            						<tr>
                        								<td colspan="5"><center>&nbsp;</center></td>
                        							</tr>
                            						<tr>
                        								<td colspan="5"><center><?php echo "You exceeded the standard check-out time. Additional room fee has been charged to you."; ?></center></td>
                        							</tr>
                            						<?php
                            									}
                            						
								}
								
								$_SESSION["witotal"] = $witotal;
							?>
					<tr>
						<td>&nbsp;</td>
						<td style="font-weight: bold; font-size: 15px">&nbsp;</td>
					</tr>		
					<tr>
						<td>&nbsp;</td>
						<td style="font-weight: bold; font-size: 15px">&nbsp;</td>
					</tr>		
					<tr>
						<td colspan="2">&nbsp;</td>
						<td colspan="2" style="font-weight: bold; font-size: 15px">Total Room Fee:</td>
					</tr>		
					<tr>
						<td colspan="2">&nbsp;</td>
						<td colspan="2" style="font-size: 15px"><?php echo "Php ".number_format($total, 2); ?></td>
					</tr>
						</table>
					</tr>
				</table>
				</center>
            </div>
				<br>
				<br></div>
				  
					<input type="text" id="total" value="<?php echo $total; ?>" hidden readonly>
					<div class="clearfix"></div>
					<button type="" id="proceed" name="" style="float:right" class="btn btn-success">Proceed</button>
                  </div>
                </div>
              </div>
			  
          <div class="clearfix"></div>
		</div>
<?php	
}
else{
?>
		

		<!-- page content -->
        
			
			
			
				<center><h2 style="font-size:30px">Customer Directory</h2></center>
				
						<?php
				if(isset($_GET["message"])){
						?>
				  <div class="
				  <?php 
				if($_GET["message"] == "Successfully recorded additional charges." || $_GET["message"] == "Successfully updated records." || $_GET["message"] == "Successfully checked-out guest." || $_GET["message"] == "Successfully recorded payment." || $_GET["message"] == "Room successfully made available.")
				  {
					  echo "alert alert-success alert-dismissible fade in";
				  }
				  else{
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
						history.pushState(null, '', '/directory.php');
					</script>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:12%">Room Number</th>
                          <th style="width:12%">Client</th>
                          <th style="width:13%">Check-in Date</th>
                          <th style="width:13%">Exp. Check-out Date</th>
                          <th style="width:50%">Action</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$sqlquery = "SELECT * FROM room JOIN checkin ON room.CheckinID=checkin.CheckinID JOIN walkin ON walkin.WalkinID=checkin.WalkinID WHERE room.Status='IN-USE'"; 
						$sqlquery_ = "SELECT * FROM room JOIN checkin ON room.CheckinID=checkin.CheckinID JOIN reservation ON reservation.ReservationID=checkin.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE room.Status='IN-USE'";
						$res = mysqli_query($conn, $sqlquery);
						$rowStud = mysqli_fetch_array($res);
						$res_ = mysqli_query($conn, $sqlquery_);
						$rowStud_ = mysqli_fetch_array($res_);
						if(mysqli_num_rows($res) == 0 && mysqli_num_rows($res_) == 0){
							echo "
								<tr><td colspan='5'><center>No records found.</center></td></tr>
							";
						}
						else{
						if(mysqli_num_rows($res) > 0 ){
						do{
						$rmnumber = $rowStud["RoomNumber"];
						$client = $rowStud["ClientName"];
						$checkin = $rowStud["CheckinDateTime"];
						$chkid = $rowStud["CheckinID"];
						$checkoit = $rowStud["CheckoutDateTime"];
						$eo = false;
						//check if there is more than 1 IN-USE and same CheckinID
						$chk = "SELECT * FROM room WHERE Status='IN-USE' AND CheckinID=$chkid";
						$reschk = mysqli_query($conn, $chk);
						$numchk = mysqli_num_rows($reschk);
						if($numchk > 1){
						    $eo = true;
						}
						
						?>
						<tr>
                          <td><?php echo $rmnumber; ?></td>
                          <td><?php echo $client; ?></td>
                          <td><?php echo date_format(date_create($checkin), "F j, Y"); ?></td>
                          <td><?php echo date_format(date_create($checkoit), "F j, Y"); ?></td>
                          <td><center>
                            <button type="button" onclick="openModalCharge(this.id)" id="<?php echo $rmnumber; ?>" class="btn btn-round btn-primary btn-sm">Additional</button>
						  <button type="button" onclick="openModal1(this.id)" id="<?php echo $rmnumber; ?>" class="btn btn-round btn-success btn-sm">Room Transfer</button>
						  <?php
						  if($eo){
						  ?>
						  <button type="button" onclick="EO(this.id)" id="<?php echo $rmnumber; ?>" class="btn btn-round btn-primary btn-sm">Early Out</button>
						  <?php
						  }
						  ?>
						  <a href="directory.php?out=<?php echo $chkid; ?>"><button type="button" id="<?php echo $chkid; ?>" class="btn btn-round btn-warning btn-sm">Check-out</button></a></center></td>
                         </tr>
						<?php
						}while($rowStud = mysqli_fetch_array($res));
						}
						if(mysqli_num_rows($res_) > 0){
						do{
						$rmnumberx = $rowStud_["RoomNumber"];
						$clientx = $rowStud_["Name"];
						$checkinx = $rowStud_["CheckinDateTime"];
						$chkidx = $rowStud_["CheckinID"];
					    $checkoitx = $rowStud_["CheckoutDate"];
						$eox = false;
						//check if there is more than 1 IN-USE and same CheckinID
						$chkx = "SELECT * FROM room WHERE Status='IN-USE' AND CheckinID=$chkidx";
						$reschkx = mysqli_query($conn, $chkx);
						$numchkx = mysqli_num_rows($reschkx);
						if($numchkx > 1){
						    $eox = true;
						}
						?>
						<tr>
                          <td><?php echo $rmnumberx; ?></td>
                          <td><?php echo $clientx; ?></td>
                          <td><?php echo date_format(date_create($checkinx), "F j, Y"); ?></td>
                          <td><?php echo date_format(date_create($checkoitx), "F j, Y"); ?></td>
                          <td><center>
                              <button type="button" onclick="openModalCharge(this.id)" id="<?php echo $rmnumberx; ?>" class="btn btn-round btn-primary btn-sm">Additional</button>
						  <button type="button" onclick="openModal1(this.id)" id="<?php echo $rmnumberx; ?>" class="btn btn-round btn-success btn-sm">Room Transfer</button>
						  <?php
						  if($eox){
						  ?>
						  <button type="button" onclick="EO(this.id)" id="<?php echo $rmnumberx; ?>" class="btn btn-round btn-primary btn-sm">Early Out</button>
						  <?php
						  }
						  ?>
						  <a href="directory.php?out=<?php echo $chkidx; ?>"><button type="button" id="<?php echo $chkidx; ?>" class="btn btn-round btn-warning btn-sm">Check-out</button></a></center></td>
                         </tr>
						<?php
						}while($rowStud_ = mysqli_fetch_array($res_));
						}
						}
						?>
                      </tbody>
                    </table>
					</form>
                  </div>
				
				
                </div>
				
              
		
		
		<?php
		}
		?>
        <!-- /page content -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
		<script type="text/javascript">
			function openModal(id){
				$('#modal').modal('show');
				$("#resmod").val(id);
			}

			var rmtrans = "";

			
		function openModal1(id){
				$('#modal1').modal('show');
				$("#resmod1").val(id);
				
				
				
				//get current room
				$.ajax({
					url: "transfer.php",
					method: "post",
					data: {
						rmnumber : id
					},
					success: function(res){
					    if(res == "meron"){
					        swal("Validation", "You can only transfer once", "warning");
					        $('#modal1').modal('hide');
					    }
					    else{
					 $("#avroom").html(res);
					 //alert(res);

rmtrans = $("#rmavail").val();
$.ajax({
	url: "transfer.php",
	method: "post",
	data: {
		rmdet: "la lang",
		rmnum: rmtrans
	},
	success: function(res){
		$("#rmdet").html(res);
	}
});
				
					    }
				
					}
				
				});
			}
			
function chgdet(){
rmtrans = $("#rmavail").val();
$.ajax({
	url: "transfer.php",
	method: "post",
	data: {
		rmdet: "la lang",
		rmnum: rmtrans
	},
	success: function(res){
		$("#rmdet").html(res);
	}
});
}
			
			
$('.checkbox').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){
			  $("#selected").prop("disabled", false);
			  $("#selected_").prop("disabled", false);
			  $("#selected2").prop("disabled", false);
		  }else{
			  $("#selected").prop("disabled", true);
			  $("#selected_").prop("disabled", true);
			  $("#selected2").prop("disabled", true);
		  }
});

$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    } );
} );

function validate(){
	var ren = parseFloat($("#ren").val());
	var total = <?php
		if(isset($finalbill)){
			echo $finalbill;
		}
		else{
			echo 0;
		}
	?>;
	
	if(ren < total){
		swal("Validation", "The rendered amount should be greater than the actual payment to settle.", "warning");
		return false;
	}
	else{
		return true;
	}
}

function EO(id){
swal({
  title: "Are you sure?",
  text: "Are you sure you want to make this room available?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, proceed!",
  closeOnConfirm: false
},
function(isConfirm) {
	if (isConfirm) {
			$.ajax({
				url: "early_out.php",
				method: "post",
				data: {
					id: id
				},
				success: function(res){
					window.location.href="directory.php?message=Room successfully made available.";
				}
			});
		}
		else{
			return false;
		}
    });
}

function confirmSwal(){
swal({
  title: "Are you sure?",
  text: "Records are about to be deleted!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(isConfirm) {
        if (isConfirm) {
var checked = []
$("input[name='facID[]']:checked").each(function ()
{
    checked.push($(this).val());
});
			
            $.ajax({
					url: "delete_selectedFac.php",
					method: "POST",
					data: {
						facID_POST : checked},
					success: function(result)
						{
							swal("Success!", "Records successfully deleted!", "success");
							setTimeout(function(){
							location.reload();
							}, 3000);
						}
				});
        } else {
            return false;
        }
    }
)};



		</script>
				<div class="modal fade bs-example-modal-lg" id="modalCharge" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="payment.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Additional Charge</h4>
                        </div>
                        <div class="modal-body">
                <center>
                    <?php
			  $mat = "SELECT * FROM settings WHERE SettingsID=1";
			  $resmat = mysqli_query($conn, $mat);
			  $rowmat = mysqli_fetch_array($resmat);
			  $matprice = $rowmat["MattressPrice"];
			  $jacprice = $rowmat["JacuzziPrice"];
			  ?>
			  
                <div id="messin" style="font-size:15px; font-weight: bold"><input type="checkbox" id="jacuzzi"> Jacuzzi (<?php echo "Php ".number_format($jacprice, 2); ?>)</div>
			 <br>
			 
			  <script>
			  //script for checkbox -> update amount to pay
$('#jacuzzi').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){ //nakacheck
                var amt = $("#amtToPay").val();
                var price = <?php echo $jacprice; ?>;
                var tot = parseFloat(amt)+parseFloat(price);
                $("#amtToPay").val(tot.toFixed(2));
                $("#amtrendered").attr("min", tot);
			  
		  }else{
			  var amt = $("#amtToPay").val();
                var price = <?php echo $jacprice; ?>;
                var tot = parseFloat(amt)-parseFloat(price);
                $("#amtToPay").val(tot.toFixed(2));
                $("#amtrendered").attr("min", tot);
		  }
});
			  </script>
			  
			  
			  
			  
			  <div id="messin" style="font-size:15px; font-weight: bold">Mattress (<?php echo "Php ".number_format($matprice, 2); ?> each):  </div>
			    <div>
                <input type="number" name="" id="mattress" class="form-control" style="width:70%" min="1" max="100"/>
              </div>
			  <br><br>
			  
			  <script>
			      $("#mattress").on('keyup', function () {
						        var quan = parseFloat($("#mattress").val());
						        if(isNaN(quan)){
						            quan = 0;
						        }
						        var amt = $("#amtToPay").val();
                                var price = <?php echo $matprice; ?>;
                                var tot = parseFloat(price * quan);
                        
                        var check = $("input:checkbox:checked").length;
                        if(check > 0){ //nakacheck    
                            tot = tot + <?php echo $jacprice; ?>;
                        }
                    
                                $("#amtToPay").val(tot.toFixed(2));
                                $("#amtrendered").attr("min", tot);
                            
						    });
			  </script>
			  
			  
             <div id="messin" style="font-size:15px; font-weight: bold">Amount to Pay:  </div>
			  <div>
                <input type="number" name="amttopayx" step="any" id="amtToPay" class="form-control" readonly style="width:70%" value="0.00" min="1" max="1000000"/>
              </div>
			  <br><br>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Rendered Amount:</div>
			  <div>
				<input type="text" id="resmod" hidden readonly name="resid">
                <input type="number" name="amtrendered" id="amtrendered" class="form-control" placeholder="0.00" max="1000000" required="" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="payAdd" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  
				  <!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="transfer.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Room Transfer</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Available Rooms:</div>
			  <div id="avroom">

              </div>
			  <br><br>
			  <div id="rmdet"></div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <input type="text" id="resmod1" hidden readonly name="resid">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="trans" id="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
		
		
<script>

$.ajax({
	url: "additional.php",
	method: "post",
	success: function(res){
		var br = res.split("#");
		$("#additional").html(br[1]);
		$("#misc").val(br[0]);
	}
}); 

function openModalCharge(id){
            //token the id;
            //id;amttopay
          
				$('#modalCharge').modal('show');
				$("#resmod").val(id);
				
			}

//triggers on select change
function chg(){
	//bring back quantity to 1
	$("#quan").val(1);
	
	//show amount of the additional selected
	var addid = $("#addsel").val();
	$.ajax({
		url: "additional.php",
		method: "post",
		data: {
			addid:addid
		},
		success: function(res){
			$("#misc").val(res);
		}
	});
}


//for room details

$("#proceed").click(function(){
	var total = $("#total").val();
	
	swal({ 
  title: "Total",
   text: "The current total is Php "+total,
    type: "warning" 
  },
  function(){
    window.location.href = 'directory.php?total='+total+'<?php 
		if(isset($_GET["out"])){
			echo "&id=".$_GET["out"];
		}
	?>';
});
});

$("#proceed2").submit(function(){
	var actual = parseFloat($("#ang").val());
	var snr = parseFloat($("#snrpwd").val());
	var extra = actual - <?php 
	if(isset($totalcap)){
		echo $totalcap;
	} 
	else{
		echo "0";
	}
	?>;
	if(extra < 0){
		extra = 0;
	}
	
	if(snr > actual){
		swal("Validation", "Actual number of guests should be greater than the number of senior citizens and PWDs.", "warning");
		
		return false;
	}
else{

	
	swal({ 
  title: "Number of Guests",
   text: "The actual number of guests is "+actual+" and the number of Senior Citizens and PWDs is "+snr+". The number of extra persons is "+extra+".",
    type: "warning" 
  },
  function(){
    window.location.href = 'directory.php?act='+actual+'&snr='+snr+'&extra='+extra+'<?php 
		if(isset($_GET["id"])){
			echo "&id=".$_GET["id"]."&total=".$_GET["total"];
		}
	?>';
});

}
	return false;
});


$("#proceed3").submit(function(){
	var total = <?php
		if(isset($totalxxx)){
			echo $totalxxx;
		}
		else{
			echo "0";
		}
	?>;
	var dmg = parseFloat($("#dmgfee").val());
	var cbill = (dmg+total).toFixed(2);
	var cbillx = (dmg+total);
	
	
	swal({ 
  title: "Total Bill",
   text: "The current bill is Php "+cbill,
    type: "warning" 
  },
  function(){
    window.location.href = 'directory.php?cbill='+cbillx+'<?php 
		if(isset($_GET["id"])){
			echo "&id=".$_GET["id"];
		}
	?>';
});

	return false;
});



 $("#fid").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
	 }
 });

$("#ln").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });

$("#mn").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });
	
$("#fn").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });	
	
		</script>
</script>