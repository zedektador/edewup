<?php
	include("php_connect.php");
	session_start();
	if(isset($_POST["submit"])){
		$id = $_POST["rid"];
		//get name
		$get = "SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE reservation.ReservationID=$id";
		$res = mysqli_query($conn, $get);
		$row = mysqli_fetch_array($res);
		
		$_SESSION["ed_resid"] = $id;
		$_SESSION["ed_un"] = $row["Username"];
		$_SESSION["ed_paid"] = $row["DownpaymentPaid"];
		$_SESSION["ed_balance"] = $row["RemainingBalance"];
		$_SESSION["ed_name"] = $row["Name"];
		$_SESSION["ed_in"] = $_POST["in"];
		$_SESSION["ed_out"] = $_POST["out"];
		$_SESSION["ed_guest"] = $_POST["guest"];
		header("location:reservation_list.php?rm=$id");
	}
	else{
		$_SESSION["ed_numperroom"] = $_POST["numperroom_post"];
	}
?>