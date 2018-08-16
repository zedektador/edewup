<?php
	session_start();
		$_SESSION["wi_step"] = "2";
		$_SESSION["back"] = "yes";
		header("location:reservation.php");
?>