<?php
include("php_connect.php");
if(isset($_POST["id"])){
    $id = $_POST["id"];
    $sel = "SELECT * FROM amenity WHERE AmenityID=$id";
    $res = mysqli_query($conn, $sel);
    $row = mysqli_fetch_array($res);
    echo $row["AmenityDescription"].";".$row["HourlyRate"];
}
?>