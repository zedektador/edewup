<?php
	session_start();
	$_SESSION["res_in"] = $_POST["in"];
	$_SESSION["res_out"] = $_POST["out"];
	$_SESSION["res_guest"] = $_POST["guest"];
	header("location:reserve.php");
?>