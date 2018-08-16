<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
  <link rel="icon" href="VeneracionDesign/images/favicon.png">
  
  <style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
            table, h1, h2, h3, h4, h5, h6 {
                font-family: 'montserrat';
            }
            input{ 
                  border:0; 
                  border-bottom:1.5px solid #898585;
            }
            @page{ margin:5px; }
            body{ font-family: Arial; }
            td{
                  width:20%;
                  text-align: left;
                  padding-left: .1in
            }
            .up{
              border-top-style: solid;
              border-color: black
            }
            /*.down{
              border-bottom-style: hidden;
              border-left-style: hidden;
            }*/
            .include{
              border:solid;
            }
            .four{ width:25%; }
            table{ border-collapse: collapse;
               }
            b{
               
            }
      </style>
</head>
<?php
   include("php_connect.php");
   
    $rescode = $_GET["id"];    
    $sql = "SELECT *, reservation.Status as st FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ResCode='$rescode'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    $name = $row["Name"];
    $address= $row["Address"];
    $st = $row["st"];
    $num = $row["ContactNumber"];
    $total = $row["RemainingBalance"];
    
                        $in = $row["CheckinDate"];
						$out = $row["CheckoutDate"];
						$guest = $row["Guests"];
						$mat = $row["Mattress"];
						$days = round((strtotime($out) - strtotime($in))/60/60/24);
						
	?>	<br><br>
		<img src="VeneracionDesign/images/icon-logo.png" width="auto" height="auto" style="display: block; margin:0 auto;">
		<center><h5 style="font-size: 12px; font-weight: 200;">Montalban Waterpark and Garden Resort<br/> 101 BE E Rodriguez Hwy, Rodriguez, 1860 Rizal</h5></center> <br/><br/>
			<!--	<h3>Check-in Summary</h3> -->
					<!--<h4>Guest Details</h4> -->
					<?php
					?>
					<table style="width:100%">
					    <tr>
							<td style="width:30%; font-size: 15px; font-weight: bold">Guest Details </td>
							<td style="width:70%; font-size: 18px;">
								&nbsp;
							</td>
						</tr>	
						<tr>
							<td style="width:30%; font-size: 15px; text-transform: capitalize;">Guest Name: </td>
							<td style="width:70%; font-size: 15px; text-transform: capitalize;"><?php  echo $name; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;">Address: </td>
							<td style="width:60%; font-size: 15px; "><?php echo $address; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;">Contact Number: </td>
							<td style="width:60%; font-size: 15px;"><?php echo $num; ?></td>
						</tr>
					</table>
					<br/>
					<!--<h4>Booking Details</h4>-->
					<table style="width:100%">
					    <tr>
							<td style="width:30%; font-size: 15px; font-weight: bold">Booking Details </td>
							<td style="width:70%; font-size: 18px;">
								&nbsp;
							</td>
						</tr>	
					    <tr>
							<td style="width:40%; font-size: 15px;">Booking Code: </td>
							<td style="width:60%; font-size: 15px;"><?php echo $rescode; ?></td>
						</tr>
						<tr>
							<td style="width:40%; font-size: 15px;">Check-in Date: </td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($in), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Check-out Date: </td>
							<td style="width:70%; font-size: 15px;"><?php echo date_format(date_create($out), "F j, Y"); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Days: </td>
							<td style="width:70%; font-size: 15px;"><?php echo $days." day(s)"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Guest(s): </td>
							<td style="width:70%; font-size: 15px;"><?php echo $guest." pax"; ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Room(s): </td>
							<td style="width:70%; font-size: 15px;">
								&nbsp;
							</td>
						</tr>
						<tr>
								<td colspan=2>
								<table style="width:100%; border-bottom: 1px solid black;">
									<tr style="border-top: 1px solid black; border-bottom: 1px solid black; height: 35px;">
										<td style="width:20%; font-size: 15px;"><b>Room Type</b></td>
										<td style="width:20%; font-size: 15px;"><b>Room Price</b></td>
										<td style="width:20%; font-size: 15px;"><b>Quantity</b></td>
										<td style="width:20%; font-size: 15px;"><b>Capacity</b></td>
										<td style="width:20%; font-size: 15px;"><b>Amount</b></td>
									</tr>
								<?php
							 $resloop = "SELECT *, COUNT(*) as quan FROM room_reservation JOIN room ON room_reservation.RoomNumber=room.RoomNumber JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID JOIN reservation ON reservation.ReservationID=room_reservation.ReservationID WHERE ResCode='$rescode' GROUP BY Description";
                                  $resres = mysqli_query($conn, $resloop);
                                  $rowresx = mysqli_fetch_array($resres);
                                  
                                  $totalcap = 0;
                                  do{		
                                      
                                $roomname = $rowresx["Description"];
                                $rprice = $rowresx["Price"];
                                $roomcapacity = $rowresx["Capacity"];
                                $quan = $rowresx["quan"];
                                $sub = $rprice * $days *$quan;
								$cap = $rowresx["Capacity"];
								$totalcap += $cap * $quan;
                                ?>
									<tr style="height: 30px;">
										<td style="font-size: 15px;"><?php echo $roomname; ?></td>
										<td style="font-size: 15px;"><?php echo "Php ".number_format($rprice, 2); ?></td>
										<td style="font-size: 15px;"><?php echo $quan; ?></td>
										<td style="font-size: 15px;"><?php echo $cap; ?></td>
										<td style="font-size: 15px;"><?php echo "Php ".number_format($sub, 2); ?></td>
									</tr>
									<?php
									$totalsub += $sub;
									
								}while($rowresx = mysqli_fetch_array($resres));
								?>
								</table>
								</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 18px;">&nbsp;</td>
							<td style="width:70%; font-size: 18px;">&nbsp;</td>
						</tr>
						<?php   
						    $total_ = $totalsub + $additional;
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
							<td style="width:30%; font-size: 15px; font-weight: bold">Additional Charges </td>
							<td style="width:70%; font-size: 18px;">
								&nbsp;
							</td>
						</tr>	
						<!--<tr>
							<td style="width:30%; font-size: 15px;">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr> -->
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
							<td style="width:50%; font-size: 15px;">Total Additional Charges:</td>
							<td style="width:50%; font-size: 15px;">
							    <?php echo "Php ".number_format($prmat * $mat, 2); ?>
							</td>
						</tr>
						<?php
							}
						?>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">Payment Details</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Amount: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php 
							$totalsub = ($prmat * $mat) + $totalsub;
							echo number_format($totalsub, 2); ?></td>
						</tr>
						
			<?php
			//check if paid or not
			if($st == "PENDING"){
			?>
						
		
						<tr>
							<td style="width:30%; font-size: 15px;">Reservation Fee (50%): </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($totalsub/2, 2); ?></td>
						</tr>
						<?php
						    //get maxreserve days from settings
									$settings = "SELECT * FROM settings WHERE SettingsID=1";
									$resset = mysqli_query($conn, $settings);
									$rowset = mysqli_fetch_array($resset);
									$resday = $rowset["MaxReservationDays"];
								
							$resdatex = $row["ReservationDate"];
							$NewDate= date("F j, Y", strtotime("$resdatex +$resday days" ));
						?>
						<tr>
							<td style="width:30%; font-size: 15px;">Deadline of Downpayment: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold"><?php echo $NewDate; ?></td>
						</tr>
					</table>
					<br><br>
					<hr style="border-top: dotted 1px;" />
					<center><h4 style="font-weight: bold">Payment Instruction</h4></center>
					<div style="margin-left:100px; margin-right: 100px;">
					<p style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please deposit the amount on the bank information provided.</p>
					<p style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Account Name: </b><?php echo $rowset["AccountName"]; ?></p>
					<p style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Account Number: </b><?php echo $rowset["AccountNumber"]; ?></p>
					<p style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to settle the payments before the due date will cause the expiration of your reservation.</p>
					<p style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There is strictly <b>no refund</b> for payments made but should you decide to change rooms and dates, <b>rescheduling of reservation</b> is possible.</p>
					</div>
						
			<?php
			}
			else{
			?>
			        
			            <tr>
							<td style="width:30%; font-size: 15px;">Remaining Balance: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($total, 2); ?></td>
						</tr>
						</table>
						<br><br><br>
						<center><h4 style="font-weight: bold">Instructions</h4></center>
					<br>
					<div style="margin-left:100px; margin-right: 100px;">
					<p style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please bring this itinerary slip and your proof of payment (bank slip or official receipt) on the date of check-in. Thank you!</p>
					</div>
			
			<?php
			}
			?>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script type='text/javascript'>
            window.print();
            setTimeout('closePrintView()', 1000);
    
    function closePrintView() {
      window.close();
    }
      </script>

		
    
