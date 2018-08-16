<?php
	include("php_connect.php");
	session_start();
	//input to payment table
	if(isset($_POST["pay"])){
	$amt = $_POST["amt"];
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$staff = $_SESSION["user"];
	$name = $_SESSION["name"];
	$resid = $_POST["resid"];
	
	$q = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$staff')";
	$res = mysqli_query($conn, $q);
	
	//update reservation
	$upd = "UPDATE reservation SET DownpaymentPaid=$amt , DatePaid='$today', RemainingBalance=(TotalBill - $amt), Status='PAID' WHERE ReservationID=$resid";
	$res_ = mysqli_query($conn, $upd);
	
	//print receipt
	//get id
	$get = "SELECT * FROM payment ORDER BY ORNumber DESC";
	$resget = mysqli_query($conn, $get);
	$rowget = mysqli_fetch_array($resget);
	$last = $rowget["ORNumber"];
	}
	elseif(isset($_POST["prc4"])){
	$amt = 	$_POST["totalnatalaga"];
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$todayx = date("Y-m-d H:i:s");
	$staff = $_SESSION["user"];
	
	//print receipt
	//get id
	$get = "SELECT * FROM payment ORDER BY ORNumber DESC";
	$resget = mysqli_query($conn, $get);
	$rowget = mysqli_fetch_array($resget);
	$last = $rowget["ORNumber"];
	
	$chkinID = $_POST["idlast"];
	
	
		//update checkin ->chkoutdatetime and totalamoutpaid
		$updchkin = "UPDATE checkin SET CheckoutDateTime='$todayx', TotalAmountToPay=$amt WHERE CheckinID=$chkinID";
		$resupd = mysqli_query($conn, $updchkin);
		
		//update room ->status = available and checkinid = null
		$updchkinx = "UPDATE room SET Status='AVAILABLE', CheckinID=NULL, EarlyOut=NULL WHERE CheckinID=$chkinID";
		$resupdx = mysqli_query($conn, $updchkinx);
		
	if($amt > 0){
        	$q = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$staff')";
        	$res = mysqli_query($conn, $q);		    
	}
	else{
	    header("location:directory.php?message=Successfully checked-out guest.");
	}
	}
	elseif(isset($_POST["payCharges"])){
	 $amt = $_POST["amtrendered"];
	 $amtx = $_POST["amttopayx"];
	 $id = $_POST["resid"];
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$todayx = date("Y-m-d H:i:s");
	$staff = $_SESSION["user"];
	
	//print receipt
	//get id
	$get = "SELECT * FROM payment ORDER BY ORNumber DESC";
	$resget = mysqli_query($conn, $get);
	$rowget = mysqli_fetch_array($resget);
    	$last = $rowget["ORNumber"];
    	
    //update ktv
    $upd = "UPDATE `ktv_rental` SET `Balance`=(Balance - $amt) WHERE `KTVRentalID`=$id";
    $resupd = mysqli_query($conn, $upd);
    
    //insert payment
	if($amt > 0){
        	$q = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$staff')";
        	$res = mysqli_query($conn, $q);		    
	}
	}
	elseif(isset($_POST["payChargesx"])){
	  $amt = $_POST["amtrendered"];
	 $amtx = $_POST["amttopayx"];
	 $id = $_POST["resid"];
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$todayx = date("Y-m-d H:i:s");
	$staff = $_SESSION["user"];
	
	//print receipt
	//get id
	$get = "SELECT * FROM payment ORDER BY ORNumber DESC";
	$resget = mysqli_query($conn, $get);
	$rowget = mysqli_fetch_array($resget);
	$last = $rowget["ORNumber"];
	
    //update ktv
    $upd = "UPDATE `billiards_rental` SET `Balance`=(Balance - $amt) WHERE `BilliardRentalID`=$id";
    $resupd = mysqli_query($conn, $upd);
    
    //insert payment
	if($amt > 0){
        	$q = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$staff')";
        	$res = mysqli_query($conn, $q);		    
	}
	}
	elseif(isset($_POST["payAdd"])){
	 $amt = $_POST["amtrendered"];
	 $amtx = $_POST["amttopayx"];
	 $id = $_POST["resid"];
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$todayx = date("Y-m-d H:i:s");
	$staff = $_SESSION["user"];
	
	//print receipt
	//get id
	$get = "SELECT * FROM payment ORDER BY ORNumber DESC";
	$resget = mysqli_query($conn, $get);
	$rowget = mysqli_fetch_array($resget);
	$last = $rowget["ORNumber"];
    //insert payment
	if($amt > 0){
        	$q = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$staff')";
        	$res = mysqli_query($conn, $q);		    
	}
	}
	elseif(isset($_POST["payChargesxx"])){
	 $amt = $_POST["amtrendered"];
	 $amtx = $_POST["amttopayx"];
	 $id = $_POST["resid"];
	date_default_timezone_set("Asia/Manila");
	$today = date("Y-m-d");
	$todayx = date("Y-m-d H:i:s");
	$staff = $_SESSION["user"];
	
	//print receipt
	//get id
	$get = "SELECT * FROM payment ORDER BY ORNumber DESC";
	$resget = mysqli_query($conn, $get);
	$rowget = mysqli_fetch_array($resget);
	$last = $rowget["ORNumber"];
	
    //update ktv
    $upd = "UPDATE `rentals` SET `Balance`=(Balance - $amt) WHERE `RentalID`=$id";
    $resupd = mysqli_query($conn, $upd);
    
    //insert payment
	if($amt > 0){
        	$q = "INSERT INTO `payment`(`DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('$today',$amt,'$staff')";
        	$res = mysqli_query($conn, $q);		    
	}
	}
?>
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
<body>
	<div style="width:30%; border: 1px solid black">
	<table style="font-size:10px">
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-size:15px; font-weight: bold" colspan="2"><center>Montalban Waterpark</center></td>
		</tr>
		<tr>
			<td style="font-size:15px; font-weight: bold" colspan="2"><center>and Garden Resort</center></td>
		</tr>		
		<tr>
			<td style="font-size:15px; font-weight: bold" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-size:12px; font-weight: bold" colspan="2"><center>Official Receipt</center></td>
		</tr>
		<tr>
			<td style="font-size:10px;" colspan="2"><center>#<?php echo sprintf('%08d', $last); ?></center></td>
		</tr>
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Received by: </td>
			<td style=""><?php echo $_SESSION["name"]; ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
		<?php
		if(isset($_POST["prc4"])){
		?>

		<tr>
			<td style="font-weight: bold;">Vatable Amount: </td>
			<td style=""><?php echo number_format($amt/1.12, 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">VAT(12%): </td>
			<td style=""><?php echo number_format(($amt/1.12)*0.12, 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Amount: </td>
			<td style=""><?php echo number_format($amt, 2); ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Amount Rendered: </td>
			<td style=""><?php echo number_format($_POST["rendered"], 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Change: </td>
			<td style=""><?php echo number_format($_POST["rendered"] - $amt, 2); ?></td>
		</tr>
		<?php
		}
		elseif(isset($_POST["payCharges"]) || isset($_POST["payChargesx"]) || isset($_POST["payAdd"]) || isset($_POST["payChargesxx"])){
		?>
		
		<tr>
			<td style="font-weight: bold;">Vatable Amount: </td>
			<td style=""><?php echo number_format($amtx/1.12, 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">VAT(12%): </td>
			<td style=""><?php echo number_format(($amtx/1.12)*0.12, 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Amount: </td>
			<td style=""><?php echo number_format($amtx, 2); ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Amount Rendered: </td>
			<td style=""><?php echo number_format($_POST["amtrendered"], 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Change: </td>
			<td style=""><?php echo number_format($_POST["amtrendered"] - $amtx, 2); ?></td>
		</tr>
		
		<?php
		}
		else{
		?>
		<tr>
			<td style="font-weight: bold;">Downpayment: </td>
			<td style=""><?php echo number_format($amt, 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Amount Rendered: </td>
			<td style=""><?php echo number_format($_POST["amtrendered"], 2); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Change: </td>
			<td style=""><?php echo number_format($_POST["amtrendered"] - $amt, 2); ?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td style="font-size:12px;" colspan="2">&nbsp;</td>
		</tr>
	</table>
	</div>
</body>

<script src="vendor/jquery/jquery.min.js"></script>
	<script type='text/javascript'>
		   window.print();
            setTimeout('closePrintView()', 1000);
			
    
	<?php
	if(isset($_POST["prc4"])){
	?>	
	function closePrintView() {
      document.location.href = 'directory.php?message=Successfully checked-out guest.';
    }
	<?php
	}
	elseif(isset($_POST["payCharges"])){
	?>
	function closePrintView() {
      document.location.href = 'inventory.php?message=Successfully recorded payment.';
    }
	<?php
	}
	elseif(isset($_POST["payChargesx"])){
	?>
	function closePrintView() {
      document.location.href = 'inventory.php?messagex=Successfully recorded payment.';
    }
	<?php
	}
	elseif(isset($_POST["payChargesxx"])){
	?>
	function closePrintView() {
      document.location.href = 'inventory.php?messager=Successfully recorded payment.';
    }
	<?php
	}
	elseif(isset($_POST["payAdd"])){
	?>
	function closePrintView() {
      document.location.href = 'directory.php?message=Successfully recorded payment.';
    }
	<?php
	}
	else{
	?>
    function closePrintView() {
      document.location.href = 'reservation_list.php?message=Successfully recorded payment.';
    }
	<?php
	}
	?>
      </script>