<?php
include ('php_connect.php');

if(isset($_GET['RoomType'])){
	$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	mysqli_query($conn, "INSERT INTO `room_type` (`Description`, `Price`, `AboutRoom`, `Capacity`, `RoomPic`, `TV`, `Beds`) VALUES( 
	'". $_POST['RoomType'] ."',
	". $_POST['Price'] .",
	'". $_POST['Desc'] ."',
	". $_POST['Capacity'] .",
	'$file',
	". $_POST["TV"] .",
	". $_POST["Beds"] .")");
	
	header("location:add_room.php?message=Successfully added room type.");
	}

	if(isset($_GET['RoomAdd']))
	{
		$query = mysqli_query($conn,"SELECT * FROM `room_type` WHERE `Description` = '".$_POST['option']."'");
		$row = mysqli_fetch_array($query);
		$RoomTypeid = $row['RoomTypeID'];
		$adddesc = $_POST["adddesc"];
		mysqli_query($conn,"INSERT INTO `room`(`RoomNumber`, `RoomTypeID`, `AdditionalDescription`) VALUES (
			'".$_POST['text']."','$RoomTypeid','$adddesc')");

		echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			Successfully saved. <i class = 'fa fa-check'><i/></div>";
	}

	if(isset($_GET['CheckType']))
	{
		$query = mysqli_query($conn,"SELECT * FROM `room_type` WHERE `Description` = '".$_POST['Text']."'");
		if(mysqli_num_rows($query) > 0)
		{
			echo "<input type ='hidden' id = 'Check' value = 'Yes'>";
		}
		else
		{
			echo "<input type ='hidden' id = 'Check' value = ''>";
		}
	}
	if(isset($_GET['imageRoom']))
	{
		$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$iamgeFile = $_POST['iamgeFile'];
		$query = mysqli_query($conn,"UPDATE `room_type` SET `RoomPic` = '$file' WHERE `RoomTypeID` = '$iamgeFile'");

		header("location:room_types.php");
	}
	
	?>
