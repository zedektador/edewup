<?php
include ('php_connect.php');

if(isset($_GET['addstaff'])){
	
	$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	mysqli_query($conn, "INSERT INTO `staff`(`Username`, `Password`, `Name`, `Email`, `ContactNumber`, `Address`, `Position`, `Status`,`ProfilePic`) VALUES ( 
	'".mysqli_real_escape_string($conn,$_POST['input_uname'])."',
	'".mysqli_real_escape_string($conn,$_POST['input_pass']) ."',
	'".mysqli_real_escape_string($conn,$_POST['name']) ."',
	'".mysqli_real_escape_string($conn,$_POST['input_email']) ."',
	'".mysqli_real_escape_string($conn,$_POST['input_contact']) ."',
	'".mysqli_real_escape_string($conn,$_POST['input_address']) ."',
	'".mysqli_real_escape_string($conn,$_POST['option_postion']) ."',
	'Active','$file')");

	
	header("location:staffs.php?message=Staff successfully added.");
	}

if(isset($_GET['addclient']))
{
	mysqli_query($conn,"INSERT INTO `client`(`Username`, `ClientName`, `Address`, `Email`, `Password`, `ContactNumber`, `Status`) VALUES (
		'".$_POST['input_uname']."',
		'".$_POST['input_fname']."',
		'".$_POST['input_address']."',
		'".$_POST['input_email']."',
		'".$_POST['input_pass']."',
		'".$_POST['input_contact']."',
		'Active')");

	header("location:AddAcountClient.php");
}

?>
