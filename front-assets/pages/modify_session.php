<?php
if(isset($_POST["submit"])){
    
    include("php_connect.php");
    $rescode = $_POST["bookingcode"];
    $sql = "SELECT * FROM reservation WHERE ResCode='$rescode' AND Status='PAID'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    $resid = $row["ReservationID"];
    
   
    //check if bookcode exists
    if(mysqli_num_rows($res) != 0){ //existing
        session_start();
        $_SESSION["bookCode"] = $rescode;
        header("location:modify_details.php");
    }
    else{
        header("location:modify.php?message");
    }
}
?>