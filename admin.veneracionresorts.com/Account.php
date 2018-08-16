<?php
include 'php_connect.php';
session_start();
     
	 if(isset($_GET['account'])){
		 
		 $sqltran = mysqli_query($conn, "SELECT * FROM staff WHERE `Deleted` = 'No'");
		 $count = mysqli_num_rows($sqltran);
		 if($count > 0)
		 {
			while ($row = mysqli_fetch_array($sqltran))
			{
				$Username = $row['Username'];
				$Password = $row['Password'];
				$Position = $row['Position'];
				$Name = $row['Name'];
				$Email = $row['Email'];
				$ContactNumber = $row['ContactNumber'];
				$Status = $row['Status'];
				$Address = $row['Address'];
				
				if($_SESSION['user'] == $Username)
				{
					$disabled = "disabled";
				}
				else
				{
					$disabled = "";
				}

				echo "
				<tr>
				";
				echo '<td><img src = "data:image/jpeg;base64,'.base64_encode($row['ProfilePic']).'" height = "100px;" width = "100px;" style = "padding-bottom:10px;padding:1px;border:4px solid #ccc;border-radius:10px;"></td>'; 
				echo "
				<td>$Username</td>
				<td>$Position</td>
				<td>$Name</td>
				<td>$Email</td>
				<td>$Address</td>
				<td>$ContactNumber</td>
				<td><button class='btn btn-info btn-sm' value = '$Username' id = 'btnUpdate' $disabled type = 'button'><i class = 'fa fa-eye'></i> View</button>
				<button class='btn btn-danger btn-sm' value = '$Username' id = 'btnDelete'  type = 'button' $disabled><i class = 'fa fa-trash'></i> Delete</button><br>
				<button type = 'button' class='btn btn-primary btn-sm' value = '$Username' id = 'btnImage' ><i class = 'fa fa-image'></i> Change Image</button> 
				</td>
				</tr>";
				

			}
		 }
	 
	 }
	 //delete confirmation
	if(isset($_GET['conf']))
	{
		$user = mysqli_real_escape_string($conn,$_POST['user']);
		$sqltran = mysqli_query($conn, "SELECT `Username`, `Password`, `Name`, `Email`, `ContactNumber`, `Address`, `Position`, `Status` FROM `staff` WHERE `Username` = '$user'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}
	if(isset($_GET['conf1']))
	{
		$sqltran = mysqli_query($conn, "SELECT * FROM `client` WHERE `Username` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}
	//delete
	if(isset($_GET['del']))
	{
		$sqltran = mysqli_query($conn, "UPDATE `staff` set `Deleted` = 'Yes' WHERE `Username` = '".$_POST['accid']."'");	
	}
		

	//view profile
	if(isset($_GET['view']))
	{	
		$ID = mysqli_real_escape_string($conn,$_POST['ID']);
		$sqltran = mysqli_query($conn, "SELECT `Username`, `Password`, `Name`, `Email`, `ContactNumber`, `Address`, `Position`, `Status` FROM `staff` WHERE `Username` = '$ID'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}
	if(isset($_GET['viewClient']))
	{	
		$sqltran = mysqli_query($conn, "SELECT * FROM `client` WHERE `Username` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}
	


	if(isset($_GET['updatenow']))
	{
		$sqltran = mysqli_query($conn, "UPDATE`staff` SET `Name`='".$_POST['Name']."',`Address`='".$_POST['Address']."',`Email`='".$_POST['Email']."',`ContactNumber`='".$_POST['ContactNumber']."',`Status`='".$_POST['Status']."',`Position` = '".$_POST['Position']."',`Password`='".$_POST['Pass2']."' WHERE `Username` = '".$_POST['Username']."'");
		
	}
	if(isset($_GET['updatenow1']))
	{
	    $sqltran = mysqli_query($conn, "UPDATE `client` SET `ClientName`='".$_POST['Name']."',`Address`='".$_POST['address']."',`Email`='".$_POST['email']."',`Password`='".$_POST['pass']."',`Status`='".$_POST['Status']."',`ContactNumber` = '".$_POST['contact']."',`Status`='".$_POST['status']."' WHERE `Username` = '".$_POST['uname']."'");
		
		$clientid = $_POST['uname'];
		if($_POST["status"] == "Inactive"){
		    //drop all reservations
		    $del = "DELETE FROM reservation WHERE ClientID='$clientid'";
		    $resdel = mysqli_query($conn, $del);
		}		
	}
	
	if(isset($_GET['accountclient'])){
		 
		 $sqltran = mysqli_query($conn, "SELECT * FROM client WHERE `Deleted` = 'No'");
		 $count = mysqli_num_rows($sqltran);
		 if($count > 0)
		 {
			while ($row = mysqli_fetch_array($sqltran))
			{
		        $Username = $row['Username'];
				
		        
		        $chkcl = "SELECT * FROM checkin JOIN reservation ON checkin.ReservationID=reservation.ReservationID WHERE reservation.ClientID='$Username'";	    
			    $reschk = mysqli_query($conn, $chkcl);
			    if(mysqli_num_rows($reschk) == 0){
			    
			    
			    
				$Name = $row['ClientName'];
				$Address = $row['Address'];
				$Email = $row['Email'];
				$Password = $row['Password'];
				
				$ContactNumber = $row['ContactNumber'];
				$Status = $row['Status'];
				$Address = $row['Address'];
				$Status = $row['Status'];
				echo "
				<tr>
				<td>$Username</td>
				<td>$Name</td>
				<td>$Address</td>
				<td>$Email</td>
				<td>$ContactNumber</td>
				<td><button class='btn btn-info btn-sm' value = '$Username' id = 'btnUpdate'  data-toggle='modal' data-target='#Modal_Edit'><i class = 'fa fa-eye'></i> View</button>
				<button class='btn btn-danger btn-sm' value = '$Username' id = 'btnDelete'  data-toggle='modal' data-target='#Modal_Delete'><i class = 'fa fa-trash'></i> Delete</button></td>
				</tr>";
			    }
			}
		 }
	 
	 }
	 
	 		//view profile
	if(isset($_GET['view2']))
	{
		
		$sqltran = mysqli_query($conn, "SELECT * FROM `tbl_staff` WHERE `Username` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}

	if(isset($_GET['updatenow2']))
	{
		$sqltran = mysqli_query($conn, "UPDATE `tbl_staff` SET `UserName`='".$_POST['uname']."',`Name`='".$_POST['Name']."',`Address`='".$_POST['address']."',`Email`='".$_POST['email']."',`ContactNumber`='".$_POST['contact']."',`Status`='".$_POST['status']."' , `Age` = '".$_POST['age']."', `Position` = '".$_POST['position']."' , `Birthday` = '".$_POST['birthday']."', `Gender` = '".$_POST['gender']."' WHERE `StaffID` = '".$_POST['staffid']."'");
	}

	
	 //delete confirmation for staff
	 if(isset($_GET['confstaff']))
	{
		
		$sqltran = mysqli_query($conn, "SELECT * FROM `tbl_staff` WHERE `StaffID` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}
	if(isset($_GET['del1']))
	{
		$sqltran = mysqli_query($conn, "UPDATE `client` SET `Deleted` = 'Yes' WHERE `Username` = '".$_POST['accid']."'");	
	}
    
	if(isset($_GET['accountadmin'])){
		 
		 $sqltran = mysqli_query($conn, "SELECT * FROM tbl_admin");
		 $count = mysqli_num_rows($sqltran);
		 if($count > 0)
		 {
			while ($row = mysqli_fetch_array($sqltran))
			{
				$AdminID = $row['AdminID'];
				$Name = $row['Name'];
				$contact = $row['ContactNumber'];
				$uname = $row['UserName'];
				$Position = $row['Position'];
				$age = $row['Age'];
				$email = $row['Email'];
				$Bday = $row['Birthday'];
				$Address = $row['Address'];
				$Status = $row['Status'];
				$gender = $row['Gender'];
				echo "
				<tr>
				<td>$uname</td>
				<td>$Name</td>
				<td>$Position</td>
				<td>$gender</td>
				<td>$contact</td>
				<td>$Status</td>
				<td><button class='btn btn-info btn-sm' value = '$AdminID' id = 'btnUpdate'  data-toggle='modal' data-target='#Modal_Edit'><i class = 'fa fa-eye'></i> View</button>
				<button class='btn btn-danger btn-sm' value = '$AdminID' id = 'btnDelete'  data-toggle='modal' data-target='#Modal_Delete'><i class = 'fa fa-trash'></i> Delete</button></td>
				</tr>";
			}
		 }
	 
	 }
	 
	 		//view profile
	if(isset($_GET['view3']))
	{
		
		$sqltran = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `AdminID` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}

	if(isset($_GET['updatenow3']))
	{
		$sqltran = mysqli_query($conn, "UPDATE `tbl_admin` SET `UserName`='".$_POST['uname']."',`Name`='".$_POST['Name']."',`Address`='".$_POST['address']."',`Email`='".$_POST['email']."',`ContactNumber`='".$_POST['contact']."',`Status`='".$_POST['status']."' , `Age` = '".$_POST['age']."', `Position` = '".$_POST['position']."' , `Birthday` = '".$_POST['birthday']."', `Gender` = '".$_POST['gender']."' WHERE `AdminID` = '".$_POST['adminid']."'");
	}

	
	 //delete confirmation for admin
	 if(isset($_GET['confadmin']))
	{
		
		$sqltran = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `AdminID` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($sqltran);
		echo json_encode($row);
	}
	

	if(isset($_GET['checkUname']))
	{
		$query = mysqli_query($conn,"SELECT * FROM `staff` WHERE `Username` = '".mysqli_real_escape_string($conn,$_POST['data'])."'");
		if(mysqli_num_rows($query) > 0)
		{
			echo '<input type = "hidden" id ="unameex" value = "yes">';
		}
		else
		{
			echo '<input type = "hidden" id ="unameex" value = "no">';
		}
	}

	if(isset($_GET['checkUnameClient']))
	{
		$query = mysqli_query($conn,"SELECT * FROM `client` WHERE `Username` = '".$_POST['data']."'");
		if(mysqli_num_rows($query) > 0)
		{
			echo '<input type = "hidden" id ="unameex" value = "yes">';
		}
		else
		{
			echo '<input type = "hidden" id ="unameex" value = "no">';
		}
	}


	if(isset($_GET['RoomType']))
    {
         $sqltran = mysqli_query($conn, "SELECT * FROM room_type ")or die(mysqli_error($conn));
          $row = mysqli_fetch_array($sqltran);
          do{
            echo '<tr>';
               echo '<td><img src = "data:image/jpeg;base64,'.base64_encode($row['RoomPic']).'" height = "100px;" width = "100px;" style = "padding-bottom:10px;padding:1px;border:4px solid #ccc;border-radius:10px;"></td>'; 
                  echo '<td>'. $row['Description'] . '</td>';
             echo '<td>'. $row['Price'] . '</td>';
                    echo '<td>'. $row['Capacity'] . '</td>';
                    echo '<td>'. $row['AboutRoom'] . '</td>';
                    
                    //get number of room type
                    $rtid = $row['RoomTypeID'];
                    $rmtype = "SELECT * FROM room WHERE RoomTypeID=$rtid";
                    $restype = mysqli_query($conn, $rmtype);
                    $cnt = mysqli_num_rows($restype); 
                    
                    echo "<td>$cnt</td>";
                    echo '<td width=200>';
                      
                      //make this edit and delete available if room has no checkin
                      
                      $chk = "SELECT * FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room_type.RoomTypeID=$rtid AND room.Status!='AVAILABLE'";
                      $reschk = mysqli_query($conn, $chk);
                      $rowchk = mysqli_fetch_array($reschk);
                      $numchk = mysqli_num_rows($reschk);
                      
                      //if more than 1 ibig sabihin gamit sya bawal ang editing
                      if($numchk == 0){
                      echo '<button class="btn btn-info btn-sm" value="'.$row['RoomTypeID'].'" id = "editRoomT" ><i class = "fa fa-edit" type="button"></i> Edit</button>';
                      echo '  ';
                      echo '<button class="btn btn-danger btn-sm" value="'.$row['RoomTypeID'].'" id = "DelRoomT"  type="button"><i class = "fa fa-trash"></i> Deletes</button><br>';
                      }
                      echo '<button class="btn btn-primary btn-sm" id = "ImageRoomT" value="'.$row['RoomTypeID'].'" type="button"><i class = "fa fa-image" ></i> Change Picture</button>';
                      echo '</td>';
         }while($row = mysqli_fetch_array($sqltran));
                  
	}
	if(isset($_GET['RoomTinfo']))
	{
		$query=mysqli_query($conn,"SELECT `RoomTypeID`, `Description`, `Price`, `AboutRoom`, `Capacity`, `TV`, `Beds` FROM `room_type` WHERE `RoomTypeID` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($query);
		echo json_encode($row);
	}
	if(isset($_GET['RoomTinfoConf']))
	{
		$query=mysqli_query($conn,"SELECT `RoomTypeID`, `Description`, `Price`, `AboutRoom`, `Capacity` FROM `room_type` WHERE `RoomTypeID` = '".$_POST['ID']."'");
		$row = mysqli_fetch_array($query);
		echo json_encode($row);
	}
	if(isset($_GET['DelRot']))
	{
		$query=mysqli_query($conn,"DELETE FROM `room_type` WHERE `RoomTypeID` = ".$_POST['Rid']);
		
	}
	if(isset($_GET['updateRoomType']))
	{
		$query=mysqli_query($conn,"UPDATE `room_type` SET 
			`Description` = '".$_POST['RoomType']."',
			`Price` = '".$_POST['Price']."',
			`AboutRoom` = '".$_POST['Desc']."',
			`Capacity` = '".$_POST['Capacity']."',
			`TV` = ".$_POST['Add'].",
			`Beds` = ".$_POST["Beds"]."
			WHERE `RoomTypeID` = '".$_POST['ID']."' ");
	}
	if(isset($_GET['ImageR']))
	{
		$quert = mysqli_query($conn,"SELECT * FROM `room_type` WHERE `RoomTypeID` = '".$_POST['ID']."' ");
		$row = mysqli_fetch_array($quert);
		echo '
		<label>Room Name:</label> '.$row['Description'].'<br>
		<input type = "hidden" value = "'.$row['RoomTypeID'].'" name = "iamgeFile">
		<img src = "data:image/jpeg;base64,'.base64_encode($row['RoomPic']).'" height = "100px;" width = "100px;" style = "padding-bottom:10px;padding:1px;border:4px solid #ccc;border-radius:10px;line-height:20px;">
		<br><br><input type = "file" required accept="image/*" name="image"/>';

	}

	if(isset($_GET['ImageA']))
	{
		$quert = mysqli_query($conn,"SELECT * FROM `staff` WHERE `Username` = '".$_POST['ID']."' ");
		$row = mysqli_fetch_array($quert);
		echo '
		<label>Full Name:</label> '.$row['Name'].'<br>
		<input type = "hidden" value = "'.$row['Username'].'" name = "StafID">
		<img src = "data:image/jpeg;base64,'.base64_encode($row['ProfilePic']).'" height = "100px;" width = "100px;" style = "padding-bottom:10px;padding:1px;border:4px solid #ccc;border-radius:10px;line-height:20px;">
		<br><br><input type = "file" required accept="image/*" name="imageStaff"/>';

	}

	if(isset($_GET['wew']))
	{
		$file = addslashes(file_get_contents($_FILES['imageStaff']['tmp_name']));
		$iamgeFile = $_POST['StafID'];
		$query = mysqli_query($conn,"UPDATE `staff` SET `ProfilePic` = '$file' WHERE `Username` = '$iamgeFile'");

		header("location:staff_list.php");
	}


	if(isset($_GET['resRoom'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `MaxReservationRooms` = '".$_POST['Data']."'");

	}
	if(isset($_GET['resDay'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `MaxReservationDays` = '".$_POST['Data']."'");
		
	}
	if(isset($_GET['contactPer'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `ContactPerson` = '".$_POST['Data']."'");
		
	}
	if(isset($_GET['contactNum'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `ContactNumber` = '".$_POST['Data']."'");
		
	}
	if(isset($_GET['address'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `CompanyAddress` = '".$_POST['Data']."'");
		
	}
	if(isset($_GET['checkinTime'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `CheckinTime` = '".$_POST['Data']."'");
		
	}
	if(isset($_GET['checkOut'])){
		$Data= $_POST['Data'];

		mysqli_query($conn,"UPDATE `settings` SET `CheckoutTime` = '".$_POST['Data']."'");
		
	}
	
	if(isset($_GET['charges']))
	{
	    $query = mysqli_query($conn,"SELECT * FROM `additional`");
	    while($row=mysqli_fetch_array($query)):
	        
	        
	        echo 
	        "<tr>
	           <td>".$row['Description']."</td>
	           <td>".$row['ChargePerDay']."</td>
	           <td><button class = 'btn btn-info btn-sm' data-toggle='modal' data-target='#modal_edit' value = '".$row['AdditionalID']."'  id ='editadd' ><i class = 'fa fa-edit'></i> Edit</button><button class = 'btn btn-danger btn-sm' id ='Deladd' data-toggle='modal' data-target='#Modal_Conf'  value = '".$row['AdditionalID']."'><i class = 'fa fa-trash'></i> Delete</button></td>
	        </tr>";
	        
	   endwhile;     
	
	}
	if(isset($_GET['addi']))
	{
	    $query = mysqli_query($conn,"SELECT * FROM `additional` WHERE `AdditionalID` = ".$_POST['ID']."");
	    $row=mysqli_fetch_array($query);
	    echo json_encode($row);
	    
	}
	if(isset($_GET['addidel']))
	{
	    $query = mysqli_query($conn,"SELECT * FROM `additional` WHERE `AdditionalID` = ".$_POST['ID']."");
	    $row=mysqli_fetch_array($query);
	    echo json_encode($row);
	    
	}
	if(isset($_GET['updateaddi']))
	{
	    mysqli_query($conn,"UPDATE `additional` SET `Description` = '".$_POST['desc']."', `ChargePerDay` = '".$_POST['Price']."' WHERE `AdditionalID` = '".$_POST['ID']."'");
	}
	if(isset($_GET['addadd']))
	{
	    mysqli_query($conn,"INSERT INTO `additional`(`AdditionalID`, `Description`, `ChargePerDay`) VALUES('','".$_POST['d']."','".$_POST['p']."')");
	}
	if(isset($_GET['Delnowadd']))
	{
	    mysqli_query($conn,"DELETE FROM `additional` WHERE `AdditionalID` = '".$_POST['id']."'");
	}
?>	


