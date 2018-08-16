<?php
session_start();
$_SESSION["indate"] = $_POST["indate_post"];
$_SESSION["outdate"] = $_POST["outdate_post"];
$_SESSION["guest"] = $_POST["guest_post"];
$_SESSION["numperroom"] = $_POST["numperroom_post"];
?>