<?php
include("php_connect.php");

if(isset($_POST["submitSlip"])){
    
    $rescode = $_POST["bookingcode"];
    $sql = "SELECT * FROM reservation WHERE ResCode='$rescode'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    $resid = $row["ReservationID"];
    
   
    //check if bookcode exists
    if(mysqli_num_rows($res) != 0){ //existing
        
        	
$imagename=$_FILES["fileToUpload"]["name"]; //
$imagetmp=addslashes (file_get_contents($_FILES["fileToUpload"]["tmp_name"]));//
$ctr =0;

	// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
        $ctr+=1;
    }

if ($ctr==0){
    
	$sqlx = "INSERT INTO `uploaded_slip`(`ReservationID`, `ReservationCode`, `ImageSlip`) VALUES ($resid,'$rescode','$imagetmp')";
	$resx = mysqli_query($conn, $sqlx);
	
	mysqli_close($conn);

	if($resx){
		header("location:submitproof.php?message");
	}
}
else{
    header("location:submitproof.php?message_");
}


    } 
    
    else{ //doesnt exist
        header("location:submitproof.php?messagex");
    }
}
?>