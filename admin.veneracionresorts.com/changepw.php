<?php
include("php_connect.php");
if(isset($_POST["pw"])){
    session_start();
    $npw = $_POST["npw"];
    $user= $_SESSION["user"];
    $pw = $_POST["pw"];
    //check if pw exists
    $sql = "SELECT * FROM staff WHERE Username='$user' AND Password='$pw'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    if(mysqli_num_rows($res) != 0){ //exisitng
        //code to update pw
        $upd = "UPDATE staff SET Password='$npw' WHERE Username='$user'";
        $resupd = mysqli_query($conn, $upd);
        if($resupd){
            echo "existing";
        }    
    }
    else{
        echo "not";
    }
}
?>