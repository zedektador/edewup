<?php
include("php_connect.php");
if(isset($_POST['uploadcar']))
{
    $imagename=$_FILES["fileToUpload"]["name"]; //
    $imagetmp=addslashes (file_get_contents($_FILES["fileToUpload"]["tmp_name"]));//
    $ctr =0;

	// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) 
    {
        $ctr+=1;
    }

    if ($ctr==0)
    {
    	$sqlx = "INSERT INTO `slide`(`Image`) VALUES ('$imagetmp')";
    	mysqli_query($conn, $sqlx);
    	header('Location: picCar.php?upscs=1');
    }
    else
    {
        header('Location: picCar.php?upfld=1');
    }
}
if(isset($_POST['uploadgalle']))
{
    $imagename=$_FILES["fileToUpload"]["name"]; //
    $imagetmp=addslashes (file_get_contents($_FILES["fileToUpload"]["tmp_name"]));//
    $ctr =0;

	// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) 
    {
        $ctr+=1;
    }

    if ($ctr==0)
    {
    	$sqlx = "INSERT into gallery (Image) VALUES('$imagetmp')";
    	mysqli_query($conn, $sqlx);
    	header('Location: galle.php?upscs=1');
    }
    else
    {
        header('Location: galle.php?upfld=1');
    }
    
}
?>