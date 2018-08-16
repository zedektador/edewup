<?php
include("php_connect.php");
$id = $_POST["id"]; //roomnumber
date_default_timezone_set("Asia/Manila");
$today = date("Y-m-d");

//check if 


$sql = "UPDATE room SET Status='AVAILABLE', EarlyOut='$today' WHERE RoomNumber='$id'";
$res = mysqli_query($conn, $sql);
if($res){
    echo "success";
}
?>