<?php
	include("php_connect.php");
	$id = $_POST["id"];
	$can = "UPDATE messages SET Replied='YES' WHERE MessageID=$id";
	$res = mysqli_query($conn, $can);
	if($res){
		echo "cancelled";
	}
?>