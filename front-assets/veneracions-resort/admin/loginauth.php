<?php
session_start();

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] =  hash('sha256', $_POST['password']);

include './auth.php';
$re = mysql_query("SELECT * from admin WHERE username='".$_SESSION['username']."' AND password='".$_SESSION['password']."'");
echo mysql_error();
if(mysql_num_rows($re) > 0)
{
header('Refresh: 0;url=starter.php');
} 
else
{

session_destroy();
header("location: index.html");
}
?>