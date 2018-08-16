<?php
	include("php_connect.php");
	if($_POST["type"] == "ktv"){
	$id = $_POST["id"];
	$can = "UPDATE ktv_rental SET Done='YES' WHERE KTVRentalID=$id";
	$res = mysqli_query($conn, $can);
	if($res){
		echo "ktv";
	}
	}
	elseif($_POST["type"] == "billiard"){
	$id = $_POST["id"];
	$can = "UPDATE billiards_rental SET Done='YES' WHERE BilliardRentalID=$id";
	$res = mysqli_query($conn, $can);
	if($res){
		echo "billiard";
	}
	}
	elseif($_POST["type"] == "other"){
	$id = $_POST["id"];
	$can = "UPDATE rentals SET Done='YES' WHERE RentalID=$id";
	$res = mysqli_query($conn, $can);
	if($res){
		echo "other";
	}
	}
?>