<?php
	include("php_connect.php");
	$id = $_POST["id"];
	$can = "UPDATE reservation SET Status='CANCELLED' WHERE ReservationID=$id";
	$res = mysqli_query($conn, $can);
	if($res){
		echo "cancelled";
	}
?>