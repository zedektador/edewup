<?php
	session_start();
	if(isset($_POST["submit"])){
		$_SESSION["a_name"] = $_POST["name"];
		$_SESSION["a_out"] = $_POST["out"];
		$_SESSION["a_guest"] = $_POST["guest"];
		$_SESSION["step"] = "2";
		$_SESSION["x"] = "no";
		header("location:walk_checkin.php");
	}
	elseif(isset($_POST["step4"])){
		$_SESSION["step"] = "4";
		$_SESSION["total"] = $_POST["xtotal"];
		header("location:walk_checkin.php");
	}
	else{
		$_SESSION["a_numperroom"] = $_POST["numperroom_post"];
		$_SESSION["step"] = "3";
		header("location:walk_checkin.php");
	}
?>