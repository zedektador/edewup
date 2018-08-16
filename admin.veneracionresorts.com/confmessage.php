<?php
include("php_connect.php");
if(isset($_POST["pay"])){
    $amt = $_POST["amtpaid"];
    $slipid = $_POST["lbcid"];
    date_default_timezone_set("Asia/Manila");
    $today = date("Y-m-d");
    session_start();
    $st = $_SESSION["name"];
    /*
    
    >update reservation (PAID)//
	>update uploaded_slip (YES)//
	>payment (new record)//
    */
    
    //get resid
    $sel = "SELECT * FROM uploaded_slip WHERE SlipID=$slipid";
    $res = mysqli_query($conn, $sel);
    $row = mysqli_fetch_array($res);
    $resid = $row["ReservationID"];
    
    
    	//get clientID base on lbcid
$get = "SELECT * FROM uploaded_slip JOIN reservation ON reservation.ReservationID=uploaded_slip.ReservationID JOIN client ON client.ClientID=reservation.ClientID WHERE SlipID=$slipid";
$resget = mysqli_query($conn, $get);
$rowget = mysqli_fetch_array($resget);
$email = $rowget["EmailAddress"];

// send email
mail($email,"Bank Slip Verification","The amount (Php $amt) you deposited in our bank account has been confirmed by the management. Thank you.");
    

    	$upd = "UPDATE reservation SET DownpaymentPaid=$amt , DatePaid='$today', RemainingBalance=(TotalBill - $amt), Status='PAID' WHERE ReservationID=$resid";
    	$resupd = mysqli_query($conn, $upd);
    	
    	$updSlip = "UPDATE `uploaded_slip` SET `Status`='YES' WHERE `SlipID`=$slipid";
    	$resslip = mysqli_query($conn, $updSlip);
    	
    $ins = "INSERT INTO `payment`(`ORNumber`, `DatePaid`, `AmountPaid`, `StaffReceived`) VALUES ('','$today',$amt,'$st')";
    $resins = mysqli_query($conn, $ins);
    
    //message confirm back to con_bank.php
    header("location:bankpayments.php?message=Successfully recorded payment.");
}
?>