<?php
include("php_connect.php");
if(isset($_POST["trans"])){
    $rmnumber = $_POST["rmnumber"];
    $info = $_POST["roomInfo"];
    $upd = "UPDATE room SET AdditionalDescription='$info' WHERE RoomNumber='$rmnumber'";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:maintenance.php?message=Successfully updated room information.");
    }
}
else{
$rmnumber = $_POST["rmnumber"];
$sql = "SELECT * FROM room WHERE RoomNumber='$rmnumber'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$info = $row["AdditionalDescription"];

echo "<input type='text' name='rmnumber' hidden value='$rmnumber' required>
<textarea name='roomInfo' required maxlength='150' style='resize:none; width:80%' rows='5'>$info</textarea>";
}
?>