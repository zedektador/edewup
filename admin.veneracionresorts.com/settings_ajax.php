<?php
//Step 5:
/*
diba dun sa ajax code may dalawang value tayong pinass si $_POST["fieldx"] at si S_POST["valx"];
so dito na sya ginamit.. 
igets mo na lang yung logic na ginamit ko bat ko kinuha ung 2 variables na yun. pero yung point ni ajax, para mapass mo sa page na to ung data without reloading the page. 
so si res sya yung ieecho mo back to the success function.
kung mapapansin mo ung nakalagay saken per condition echo tas ung ineecho nya is input box kaya dun sa modal ko input box ung nakalagay.
so in your case kung gusto mo na pic, ang nasa loob dapat ng echo mo is ung code for img.
so yan take a look dun sa inecho nya. yang inecho nya sya ung maseset na value ni 'res' dun sa ajax.
see Step 6 back to con_genSet
*/
include("php_connect.php");
if($_POST["fieldx"] == "maxguest"){
    echo "<input type='number' min='1' max='100' class='form-control' required name='MaxGuest' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "MaxReservationDays"){
    echo "<input type='number' min='1' max='30' class='form-control' required name='MaxReservationDaysx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "AccountName"){
    echo "<input type='text' maxlength='100' class='form-control' required name='AccountNamex' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "AccountNumber"){
    echo "<input type='text' maxlength='100' class='form-control' required name='AccountNumberx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "StandardIn"){
    echo "<input type='text' maxlength='100' class='form-control' required name='StandardInx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "StandardOut"){
    echo "<input type='text' maxlength='100' class='form-control' required name='StandardOutx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "KTV"){
    echo "<input type='number' min='1' max='1000000' class='form-control' required name='KTVx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "Billiard"){
    echo "<input type='number' min='1' max='1000000' class='form-control' required name='Billiardx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "Jacuzzi"){
    echo "<input type='number' min='1' max='1000000' class='form-control' required name='Jacuzzix' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "Mattress"){
    echo "<input type='number' min='1' max='1000000' class='form-control' required name='Mattressx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "Number"){
    echo "<input type='text' maxlength='20' class='form-control' required name='Numberx' value='".$_POST["valx"]."'>";  
}
elseif($_POST["fieldx"] == "Email"){
    echo "<input type='text' maxlength='50' class='form-control' required name='Emailx' value='".$_POST["valx"]."'>";  
}
elseif(isset($_POST["maxguest"])){
    $maxguest = $_POST["MaxGuest"];
    $upd = "UPDATE settings SET MaxGuest=$maxguest WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Max Guest updated!");
    }
}
elseif(isset($_POST["MaxReservationDays"])){
    $MaxReservationDays = $_POST["MaxReservationDaysx"];
    $upd = "UPDATE settings SET MaxReservationDays=$MaxReservationDays WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Max Reservation Days updated!");
    }
}
elseif(isset($_POST["AccountName"])){
    $AccountName = $_POST["AccountNamex"];
    $upd = "UPDATE settings SET AccountName='$AccountName' WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Account Name updated!");
    }
}
elseif(isset($_POST["AccountNumber"])){
    $AccountNumber = $_POST["AccountNumberx"];
    $upd = "UPDATE settings SET AccountNumber='$AccountNumber' WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Account Number updated!");
    }
}
elseif(isset($_POST["StandardIn"])){
    $StandardIn = $_POST["StandardInx"];
    $upd = "UPDATE settings SET StandardIn='$StandardIn' WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Standard In updated!");
    }
}
elseif(isset($_POST["StandardOut"])){
    $StandardOut = $_POST["StandardOutx"];
    $upd = "UPDATE settings SET StandardOut='$StandardOut' WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Standard Out updated!");
    }
}
elseif(isset($_POST["Jacuzzi"])){
    $Jacuzzix = $_POST["Jacuzzix"];
    $upd = "UPDATE settings SET JacuzziPrice=$Jacuzzix WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Jacuzzi Price updated!");
    }
}
elseif(isset($_POST["KTV"])){
    $KTVx = $_POST["KTVx"];
    $upd = "UPDATE settings SET KTVPricePer2Hours=$KTVx WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=KTV Price updated!");
    }
}
elseif(isset($_POST["Billiard"])){
    $Billiardx = $_POST["Billiardx"];
    $upd = "UPDATE settings SET BilliardsPricePerHour=$Billiardx WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Billiards Price updated!");
    }
}
elseif(isset($_POST["Mattress"])){
    $Mattressx = $_POST["Mattressx"];
    $upd = "UPDATE settings SET MattressPrice=$Mattressx WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Mattress Price updated!");
    }
}
elseif(isset($_POST["Number"])){
    $Numberx = $_POST["Numberx"];
    $upd = "UPDATE settings SET ContactNumber='$Numberx' WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Contact Number updated!");
    }
}
elseif(isset($_POST["Email"])){
    $Emailx = $_POST["Emailx"];
    $upd = "UPDATE settings SET EmailAddress='$Emailx' WHERE SettingsID=1";
    $resupd = mysqli_query($conn, $upd);
    if($resupd){
        header("location:genset.php?message=Email Address updated!");
    }
}
?>