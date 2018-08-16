<?php
	session_start();
	if(isset($_POST["submit"])){
		$_SESSION["wi_name"] = $_POST["name"];
		$_SESSION["wi_in"] = $_POST["in"];
		$_SESSION["wi_out"] = $_POST["out"];
		$_SESSION["wi_guest"] = $_POST["guest"];
		$_SESSION["wi_step"] = "2";
		header("location:reservation.php");
	}
	else{
		$_SESSION["wi_numperroom"] = $_POST["numperroom_post"];
		if($_SESSION["back"]=="yes"){
		    $_SESSION["wi_step"] = "4";
		    unset($_SESSION["back"]);
		}
		else{
		    $_SESSION["wi_step"] = "3";
		}
		header("location:reservation.php");
	}
?>