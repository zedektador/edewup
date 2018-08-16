<?php
	session_start();
	if(isset($_POST["from_"])){
		unset($_SESSION["wi_step"]);
	}
	else{
		$_SESSION["step"] = "1";
	}
?>