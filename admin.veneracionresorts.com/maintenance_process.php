<?php
	include("php_connect.php");
	

	if(isset($_GET['um']))
	{
		$id = $_POST['id'];
		for($count = 0; $count<count($id); $count++)
		{
			$idroom = mysqli_real_escape_string($conn, $id[$count]);
			mysqli_query($conn,"UPDATE `room` SET `Status` = 'UM' WHERE `RoomNumber` = '$idroom'");
		}	
	}
	if(isset($_GET['avail']))
	{
		$id = $_POST['id'];
		for($count = 0; $count<count($id); $count++)
		{
			$idroom = mysqli_real_escape_string($conn, $id[$count]);
			mysqli_query($conn,"UPDATE `room` SET `Status` = 'AVAILABLE' WHERE `RoomNumber` = '$idroom'");
		}	
	}
?>