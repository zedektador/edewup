<?php
    include("php_connect.php");
    echo "<select class='form-control' id='rmavail' style='width:70%' name='rmtrans'>";
	
	//query all those rooms with checkin ID
	$query = "SELECT * FROM room WHERE CheckinID IS NOT NULL";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($res);
	if(mysqli_num_rows($res) != 0){
	    do{
	            $rmnumout = $row["RoomNumber"];
	        	echo "<option value='$rmnumout'>$rmnumout</option>";
	    }while($row = mysqli_fetch_array($res));
	}
	else{
	    echo "<option value='No checked-in guest yet.'>No checked-in guest yet.</option>";
	    echo "
	    <script>
	        $('#subbtn').prop('disabled', true);
	    </script>
	    ";
	}

	echo "</select>";
	//next validation (dapat mas mahal sya dun sa dating price)
?>