<?php
	if(isset($_SESSION['user'])){
		header("location:javascript://history.go(-1)");
	}
?>