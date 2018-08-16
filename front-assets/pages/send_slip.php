<?php
session_start();
include("php_connect.php");
if(isset($_POST["post"])){
$amount = $_POST["amt"];
$number = $_POST["tracking"];	
$resid = $_POST["id"];
	
$imagename=$_FILES["fileToUpload"]["name"]; //
$imagetmp=addslashes (file_get_contents($_FILES["fileToUpload"]["tmp_name"]));//
$ctr =0;

	date_default_timezone_set("Asia/Manila");
	$date =	date("Y-m-d");

	// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
        $ctr+=1;
    }

if ($ctr==0){
    
	$sql = "INSERT INTO `lbc_payment`(`LBC_PaymentID`, `AmountPaid`, `DatePaid`, `LBCSlip`, `TrackingNumber`, `ResID`) VALUES ('',$amount,'$date','$imagetmp','$number',$resid)";
	$res = mysqli_query($conn, $sql);
	
	mysqli_close($conn);
	
	if($res){
		header("location:account.php?message=Slip successfully sent.");
	}
}
}
?>