<?php
	include("php_connect.php");
	$id = $_POST["id"];
	$sel = "SELECT * FROM uploaded_slip WHERE SlipID=$id";
	$res = mysqli_query($conn, $sel);
	$row = mysqli_fetch_array($res);
	$slip = $row["ImageSlip"];
	?>
<center><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $slip ).''; ?>" style="max-height:500px; max-width: 550px" class="img-responsive" alt=""></center>