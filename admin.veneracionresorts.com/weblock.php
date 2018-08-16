<?php
	include("php_connect.php");
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	$user=$_SESSION['user'];
	$query="SELECT * FROM staff WHERE Username='$user'";
	$result=mysqli_query($conn, $query);
	$row=mysqli_fetch_array($result);
	$id=$row['Username'];
	if($id==""){
		header("location:logout.php");
	}
?>