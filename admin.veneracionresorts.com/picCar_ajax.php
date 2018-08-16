<?php
include("php_connect.php");
$idpic=$_POST['picID'];
$res = mysqli_query($conn, "SELECT * FROM slide where SlideID=$idpic");
$row = mysqli_fetch_array($res);
$pic=$row['Image'];
if($_POST['action']=='view')
{
    echo '<img style="height:180px; width:300px;" src="data:image/jpeg;base64,'.base64_encode( $pic ).'"/>';
}
elseif($_POST['action']=='galleview')
{
    $res = mysqli_query($conn, "SELECT * FROM gallery where PicID=$idpic");
    $row = mysqli_fetch_array($res);
    $pic=$row['Image'];
    echo '<img style="height:180px; width:300px;" src="data:image/jpeg;base64,'.base64_encode( $pic ).'"/>';
}
elseif($_POST['action']=='upload')
{
    $_SESSION['idpic']=$idpic;
    ?>
    
    <form action="uploadCar.php" method="POST" enctype="multipart/form-data">
        <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" required /></br>
        <input type="submit" name="uploadcar" value="Upload" />
    </form>
    <?php
}

?>
