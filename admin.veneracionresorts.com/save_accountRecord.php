<?php
	include("php_connect.php");
	session_start();
	$name = mysqli_real_escape_string($conn, $_POST["name_post"]);
	$address = mysqli_real_escape_string($conn, $_POST["address_post"]);
	$email = mysqli_real_escape_string($conn, $_POST["email_post"]);
	$phone = mysqli_real_escape_string($conn, $_POST["phone_post"]);
	
	$_SESSION["email"] = $email;
	
	$query = "INSERT INTO `client`(`Name`, `Address`, `EmailAddress`, `Status`, `ContactNumber`, `Deleted`) VALUES ('$name','$address','$email','Active','$phone','No')";
	$res = mysqli_query($conn, $query);
	if($res){
		session_start();
		$_SESSION["wi_step"] = "4";
		$_SESSION["wi_name"] = $name;
		
		//get ID
		$getid = "SELECT * FROM client ORDER BY ClientID DESC";
		$resid = mysqli_query($conn, $getid);
		$rowid = mysqli_fetch_array($resid);
		$_SESSION["wi_clid"] = $rowid["ClientID"];
		
		echo "Successful";
	}
	else{
		echo "There's an error creating your account. Try again later.";
	}
?>