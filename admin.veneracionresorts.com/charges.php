<?php
include("php_connect.php");
if(isset($_POST["ktv"])){
    $rm = $_POST["rmtrans"];
    $hrs = $_POST["hours"];
    
    date_default_timezone_set("Asia/Manila");
    
    //settings
    $set = "SELECT * FROM settings WHERE SettingsID=1";
    $res = mysqli_query($conn, $set);
    $row = mysqli_fetch_array($res);
    $price = $row["KTVPricePer2Hours"];
    
    $now = date("H:i");
    $later = date( "H:i", strtotime( $now ) + $hrs * 3600 );
    $bal = ($hrs/2) * $price;
    
    $ins = "INSERT INTO `ktv_rental`(`RoomNumber`, `Hours`, `TimeStart`, `TimeEnd`, `Balance`) VALUES ('$rm',$hrs,'$now','$later',$bal)";
    $resins = mysqli_query($conn, $ins);
    if($resins){
        header("location:inventory.php?message=Transaction successfully recorded.");
    }
}
elseif(isset($_POST["billiards"])){
    $rm = $_POST["rmtrans"];
    $hrs = $_POST["hours"];
    
    date_default_timezone_set("Asia/Manila");
    
    //settings
    $set = "SELECT * FROM settings WHERE SettingsID=1";
    $res = mysqli_query($conn, $set);
    $row = mysqli_fetch_array($res);
    $price = $row["BilliardsPricePerHour"];
    
    $now = date("H:i");
    $later = date( "H:i", strtotime( $now ) + $hrs * 3600 );
    $bal = $hrs * $price;
    
    $ins = "INSERT INTO `billiards_rental`(`RoomNumber`, `Hours`, `TimeStart`, `TimeEnd`, `Balance`) VALUES ('$rm',$hrs,'$now','$later',$bal)";
    $resins = mysqli_query($conn, $ins);
    if($resins){
        header("location:inventory.php?messagex=Transaction successfully recorded.");
    }
}
elseif(isset($_POST["other"])){
    $rm = $_POST["rmtrans"];
    $hrs = $_POST["hours"];
    $amid = $_POST["amenity"];
    
    date_default_timezone_set("Asia/Manila");
    
    //settings
    $set = "SELECT * FROM amenity WHERE AmenityID=$amid";
    $res = mysqli_query($conn, $set);
    $row = mysqli_fetch_array($res);
    $price = $row["HourlyRate"];
    
    $now = date("H:i");
    $later = date( "H:i", strtotime( $now ) + $hrs * 3600 );
    $bal = $hrs * $price;
    
    $ins = "INSERT INTO `rentals`(`RoomNumber`, `Hours`, `TimeStart`, `TimeEnd`, `Balance`, `Done`, `AmenityID`) VALUES ('$rm',$hrs,'$now','$later',$bal,'No',$amid)";
    $resins = mysqli_query($conn, $ins);
    if($resins){
        header("location:inventory.php?messager=Transaction successfully recorded.");
    }
}
?>

