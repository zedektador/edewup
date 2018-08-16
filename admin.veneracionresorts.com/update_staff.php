<?php
include("php_connect.php");
if(isset($_POST["submit"])){
    session_start();
    $name = $_POST["name"];
    $address = $_POST["address"]; 
    $email = $_POST["email"]; 
    $number = $_POST["number"];
    $user = $_SESSION["user"];
    
    $upd = "UPDATE `staff` SET `Name`='$name',`Email`='$email',`ContactNumber`='$number',`Address`='$address' WHERE `Username`='$user'";
    $res = mysqli_query($conn, $upd);
    if($res){
        header("location:profile.php?mess");
    }
}
?>