<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
  <style type="text/css">
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
	session_start();
	if(isset($_POST["next"])){
	    include("php_connect.php");
	    date_default_timezone_set("Asia/Manila");
	    $today = date("Y-m-d");
	    $amt = $_POST["disc"];
	    $rfee = $_POST["rfee"];
	    $rec = $_SESSION["name"];
		$sql = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$rec')";
	    $res = mysqli_query($conn, $sql);
	    
	    unset($_SESSION["bayadna"]);
		?>
		<center><img src="images/MONTALBAN.jpg"></center>
		<center><h1>Montalban Waterpark and Garden Resort</h1></center>
				<h3>Check-in Summary</h3>
					<h4>Guest Details</h4>
					<?php
					?>
					<table style="width:100%">
						<tr>
							<td style="width:40%; font-size: 15px;">Name: </td>
							<td style="width:60%; font-size: 15px;"><?php echo $_SESSION["a_name"]; ?></td>
						</tr>
					</table>
					<h4>Booking Details</h4>
					<?php
						$today = date("Y-m-d");
						$out = $_SESSION["a_out"];
						$guest = $_SESSION["a_guest"];
						$days = round((strtotime($_SESSION["a_out"]) - strtotime($today))/60/60/24);
					?>
					<table style="width:100%">
						<tr>
							<td style="width:40%; font-size: 15px;">Check-in Date: </td>
							<td style="width:60%; font-size: 15px;"><?php echo date_format(date_create($today), "F j, Y"); ?></td>
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
							<td style="width:30%; font-size: 15px; font-weight: bold">Room(s): </td>
							<td style="width:70%; font-size: 15px;">
								&nbsp;
							</td>
						</tr>
						<tr>
								<td colspan=2>
								<table style="width:100%">
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
										$totalcap = $cap * $quantity;
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
							<td style="width:30%; font-size: 15px; font-weight:bold">&nbsp;</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px; font-weight:bold">Payment Details</td>
							<td style="width:70%; font-size: 15px;">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Vatable Amount:</td>
							<td style="width:70%; font-size: 15px;"><?php 
								echo "Php ".number_format($_POST["disc"]/1.12, 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">VAT (12%):</td>
							<td style="width:70%; font-size: 15px;"><?php 
							echo "Php ".number_format(($_POST["disc"]/1.12)*0.12, 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Total Amount: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($_POST["disc"], 2); ?></td>
						</tr>
						
						<tr>
							<td style="width:30%; font-size: 15px;">Amount Paid: </td>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($_POST["paid"], 2); ?></td>
						</tr>
						<tr>
							<td style="width:30%; font-size: 15px;">Change: </td>
							<?php
							$change = $_POST["paid"] - $_POST["disc"];
							?>
							<td style="width:70%; font-size: 15px; font-weight: bold">Php <?php echo number_format($change, 2); ?></td>
						</tr>
					</table>
					
					<?php
					//unset the step to start from the first step of walk in checkin
					$_SESSION["step"] = 1;
					?>
						
	<script src="vendor/jquery/jquery.min.js"></script>
	<script type='text/javascript'>
            window.print();
            setTimeout('closePrintView()', 1000);
    
    function closePrintView() {
      document.location.href = 'walk_checkin.php';
    }
      </script>
	<?php
	}
	?>
		
    