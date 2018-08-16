<?php
date_default_timezone_set("Asia/Manila");
$today = date("Y-m-d");
		if(isset($_GET["in"])){
			  ?>
			
				<center><h2 style="font-size:30px">Assign Room</h2></center>
				<?php

				if(isset($_GET["mess"])){
						?>
				  <div class="
				  <?php 
				  if($_GET["mess"] == "The rooms you selected do not match the actual number of rooms.")
				  {
					  echo "alert alert-warning alert-dismissible fade in";
				  }
				  else{
					  echo "alert alert-success alert-dismissible fade in";
				  }
				  ?>" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["mess"]; ?></strong></center>
					
                  </div>
					  <?php
					  }
					  ?>
					  
						<div class="">
            
				<div class="x_panel">
                  <div class="x_content">
					<form id="chk" action="chkin_process_res.php" method="post">
					<table id="example" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
						  <th style="width:20%">Room Number</th>
						  <th style="width:30%">Image</th>
                          <th style="width:15%">Room Type</th>
                          <th style="width:25%">Description</th>
                          <th style="width:10%">Capacity</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
							//get per room
								//count per room type then get room id
								
							$resid_ = $_GET["in"];	
							$getperroom = "SELECT *, COUNT(*) as cntperroom FROM room_reservation JOIN room ON room.RoomNumber=room_reservation.RoomNumber JOIN room_type ON room_type.RoomTypeID=room.RoomTypeID WHERE room_reservation.ReservationID=$resid_ GROUP BY room_type.Description";
							
							$resperroom = mysqli_query($conn, $getperroom);
							$rowperroom = mysqli_fetch_array($resperroom);
							$perroom_ = "";
							$message = "";
							if(mysqli_num_rows($resperroom) != 0){
								do{
									$perroom_ .= $rowperroom["cntperroom"].",".$rowperroom["RoomTypeID"].";";
									$message .= $rowperroom["cntperroom"]." ".$rowperroom["Description"].", ";
								}while($rowperroom = mysqli_fetch_array($resperroom));
							}
						
							$perroom = rtrim($perroom_, ';');
							$arrayvar = explode(";",$perroom);
							foreach($arrayvar as $a){
									$break = explode(",", $a);
									$quantity = $break[0];
									$roomnum = $break[1];
									$rmselected = "";
									if($quantity != 0){
										//get room price
										$rooms = "SELECT *, room_type.RoomTypeID as rtid FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room.Status='AVAILABLE' AND room_type.RoomTypeID=$roomnum GROUP BY room_type.Description";
										$res = mysqli_query($conn, $rooms);
										$row = mysqli_fetch_array($res);
										if(mysqli_num_rows($res) != 0){
										do{
												$roomtype = $row["Description"];
												$about = $row["AboutRoom"];
												$cap = $row["Capacity"];
												$pic = $row["RoomPic"];
												$rn = $row["RoomNumber"];
												$rtid = $row["rtid"];
											?>
					
						<tr>
						    <td>
							 <table>
							     <?php
							     $ind = "SELECT * FROM room WHERE RoomTypeID=$rtid AND Status='AVAILABLE'";
							     $resind = mysqli_query($conn, $ind);
							     $rowind = mysqli_fetch_array($resind);
							     if(mysqli_num_rows($resind) != 0){
							       do{
							           $rnx = $rowind["RoomNumber"];
							     ?>
							     <tr>
							     <td><center><input type="checkbox" class="checkbox" name="rmnumber[]" value="<?php echo $rnx; ?>"></center></td>
								<td><?php echo $rnx; ?></td>
							    </tr>
							     <?php
							       }while($rowind = mysqli_fetch_array($resind));
							     }
							     ?>
							 </table>
							</td>
							<td><center><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $pic ).''; ?>" style="max-height:260px" class="img-responsive" alt=""></center></	td>
							<td><?php echo $roomtype; ?></td>
							<td><?php echo $about; ?></td>
							<td><?php echo $cap; ?></td>
                        </tr>
					  
											<?php	
										}while($row = mysqli_fetch_array($res));
										}
									}
								}
							?>
							</tbody>
						</table>
						<div  style="min-height:60px">
						<input type="text" id="mess_" value="<?php 
						$messy = rtrim($message, ', ');
						echo $messy; ?>" hidden readonly>
						<input type="text" name="in_id" value="<?php echo $_GET["in"]; ?>" hidden readonly>
						<input type="text" name="roomselected" value="<?php echo $perroom_; ?>" hidden readonly>
						<button style="float:right; margin-top:20px" type="submit" id="cnf" name="checkin" onclick="return wait()" class="btn btn-primary" disabled>Check-in</button>
						
						<script>
							var mess = $("#mess_").val();
							swal("Reserved Rooms", mess, "warning");
						</script>
						</div>
						</form>
					</div>
					</div>
            </div>
		<?php
		}
		else{
?>
		<!-- page content -->
				<div class="">
            
				<center><h2 style="font-size:30px">Expected Guests for the Day</h2>
				<h4><?php echo date_format(date_create($today), "F j, Y"); ?></h4></center>
				
						<?php
					  if(isset($_GET["mess"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["mess"]; ?></strong></center>
					<script>
						history.pushState(null, '', '/index.php');
					</script>
                  </div>
					  <?php					
					  }
					  ?>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table id="examples" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th style="width:12%">Guest's Name</th>
                          <th style="width:15%">Reservation Code</th>
                          <th style="width:12%">Reservation Date</th>
                          <th style="width:12%">Check-in Date</th>
                          <th style="width:12%">Check-out Date</th>
                          <th style="width:13%">Guest</th>
                          <th style="width:10%">Additional Mattress</th>
						  <th style="width:14%">Check-in</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$sqlquery = "SELECT * FROM reservation JOIN client ON client.ClientID=reservation.ClientID WHERE CheckinDate='$today' AND reservation.Status='PAID'";
						$res = mysqli_query($conn, $sqlquery);
						$rowStud = mysqli_fetch_array($res);
						if(mysqli_num_rows($res) == 0){
							echo "
								<tr><td colspan='8'><center>No records found.</center></td></tr>
							";
						}
						else{
						do{
						$client = $rowStud["Name"];
						$resdate = $rowStud["ReservationDate"];
						$indate = $rowStud["CheckinDate"];
						$outdate = $rowStud["CheckoutDate"];
						$guest = $rowStud["Guests"];
						$resid = $rowStud["ReservationID"];
						$rescode = $rowStud["ResCode"];
						$mat = $rowStud["Mattress"];
						?>
						<tr>
                          <td><?php echo $client; ?></td>
                          <td><?php echo $rescode; ?></td>
                          <td><?php echo date_format(date_create($resdate), "M j, Y"); ?></td>
                          <td><?php echo date_format(date_create($indate), "M j, Y"); ?></td>
                          <td><?php echo date_format(date_create($outdate), "M j, Y"); ?></td>
                          <td><?php echo $guest; ?></td>
                          <td><?php echo $mat; ?></td>
						  <td><center><a href="walk_checkin.php?cdid=<?php echo $resid; ?>"><button type="button" id="<?php echo $resid; ?>" class="btn btn-round btn-success btn-sm">Check-in</button></a></center></td>
                         </tr>
						<?php
						}while($rowStud = mysqli_fetch_array($res));
						}
						?>
                      </tbody>
                    </table>
					</form>
                  </div>
				
				
                </div>
				
              </div>
		<?php
		}
		?>
        <!-- /page content -->
		<script type="text/javascript">
			function openModal(facID){
				$('#modal').modal('show');
				
				$.ajax({
					url: "ajax_groupHandled.php",
					method: "POST",
					data: {
						facID_POST : facID},
					success: function(result)
						{
						$("#result").html(result);
						}
				});
			}
			
			function openModal1(){
				$('#modal1').modal('show');
			}
			

$('.checkbox').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){
			  $("#selected").prop("disabled", false);
			  $("#selected_").prop("disabled", false);
			  $("#selected2").prop("disabled", false);
		  }else{
			  $("#selected").prop("disabled", true);
			  $("#selected_").prop("disabled", true);
			  $("#selected2").prop("disabled", true);
		  }
});

$('.checkbox').click(function() {
		  var check = $("input:checkbox:checked").length;
          if(check > 0){
			  $("#cnf").prop("disabled", false);
		  }else{
			  $("#cnf").prop("disabled", true);
		  }
});

function wait(){

swal({
  title: "Proceed?",
  text: "Be sure that the selected rooms match the number or rooms per room type requested by the client!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, proceed!",
  closeOnConfirm: false
},
function(){
  //redirect page;
  document.getElementById("chk").submit();
});
	
	return false;
	
}

function confirmSwal(){
swal({
  title: "Are you sure?",
  text: "Records are about to be deleted!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(isConfirm) {
        if (isConfirm) {
var checked = []
$("input[name='facID[]']:checked").each(function ()
{
    checked.push($(this).val());
});
			
            $.ajax({
					url: "delete_selectedFac.php",
					method: "POST",
					data: {
						facID_POST : checked},
					success: function(result)
						{
							swal("Success!", "Records successfully deleted!", "success");
							setTimeout(function(){
							location.reload();
							}, 3000);
						}
				});
        } else {
            return false;
        }
    }
)};



		</script>
				<!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:40%">
                      <div class="modal-content">
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Groups Handled</h4>
                        </div>
                        <div class="modal-body">
                
						<div id="result"></div>
					
                	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
		
		
		<!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:40%">
                      <div class="modal-content">
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="add_faculty.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Faculty Details</h4>
                        </div>
                        <div class="modal-body">
						
						<div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='first-name'>Faculty ID
                        </label>
                        <div class='col-md-8 col-sm-6 col-xs-12'>
							<input type="text" id="fid" class="form-control" maxlength="15" name="facID" required></textarea>
						</div>
                      </div>
					  
					  <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='first-name'>First Name
                        </label>
                        <div class='col-md-8 col-sm-6 col-xs-12'>
							<input type="text" id="fn" class="form-control" maxlength="30" name="fname" required></textarea>
						</div>
                      </div>
					  
					  <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='first-name'>Middle Name
                        </label>
                        <div class='col-md-8 col-sm-6 col-xs-12'>
							<input type="text" id="mn" class="form-control" maxlength="30" name="mname" required></textarea>
						</div>
                      </div>
					  
					  <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='first-name'>Last Name
                        </label>
                        <div class='col-md-8 col-sm-6 col-xs-12'>
							<input type="text" id="ln" class="form-control" maxlength="30" name="lname" required></textarea>
						</div>
                      </div>
						
						
						</div>
						<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
<script>


$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]]
    } );
} );

 $("#fid").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
	 }
 });

$("#ln").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });

$("#mn").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });
	
$("#fn").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });	
	
function openModal(studID){
				$.ajax({
					url: "ajax_PWfac.php",
					method: "POST",
					data: {
						studID_POST : studID},
					success: function(result)
						{
							swal("Password!", "Your password is: "+result, "warning");
						}
				});
			}
		</script>
</script>