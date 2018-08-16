<?php
include("php_connect.php");
if(isset($_POST["submit"])){
	$name = $_POST["name"];
	$number = $_POST["telephone"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	$sql = "INSERT INTO `messages`(`Name`, `ContactNumber`, `EmailAddress`, `Subject`, `Message`) VALUES ('$name', '$number', '$email', '$subject', '$message')";
	$res = mysqli_query($conn, $sql);
	if($res){
		header("location:contactt.php?success");
	}
}
?>