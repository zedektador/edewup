<?php
include("php_connect.php");
if(isset($_POST["login"])){
$uname= $_POST["name"];
$pw= $_POST["password"];
$query = "SELECT * FROM staff WHERE Username='$uname' AND Password='$pw'";
$result=mysqli_query($conn, $query);
$rowsql = mysqli_fetch_array($result);
				if(mysqli_num_rows($result) == 1){ //no record found in the SA -> faculty admin
					session_start();
					$_SESSION['user']=$rowsql['Username'];
					$_SESSION['name']=$rowsql["Name"];
					$_SESSION['as']=$rowsql["Position"];
					$response="Log-in successful";				
				}
				else{
					$response="Log-in failed";
				}
header("location:signin.php?res=".$response);
}
?>