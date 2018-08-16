<?php
include("php_connect.php");
if(isset($_POST["amenityadd"])){
    $desc = $_POST["amenity"];
    $rate = $_POST["rate"];
    $sql = "INSERT INTO `amenity`(`AmenityDescription`, `HourlyRate`) VALUES ('$desc',$rate)";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("location:amenities.php?message=Successfully added an amenity.");
    }
}
elseif(isset($_POST["amenityedit"])){
    $id = $_POST["id"];
    $desc = $_POST["amenity"];
    $rate = $_POST["rate"];
    $sql = "UPDATE `amenity` SET `AmenityDescription`='$desc',`HourlyRate`=$rate WHERE `AmenityID`=$id";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("location:amenities.php?message=Successfully edited selected amenity.");
    }  
}
elseif(isset($_POST["del"])){
     $id = $_POST["id"];
     $sql = "DELETE FROM `amenity` WHERE AmenityID=$id";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("location:amenities.php?message=Successfully deleted amenity.");
    }  
}
?>