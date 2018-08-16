<?php
include("weblock.php");
?>
		<!-- page content -->
        
			
				<center><h2 style="font-size:30px">Room Maintenance</h2></center>
				
						<?php
					  if(isset($_GET["message"]) && $_GET["message"] != "Faculty ID already exist."){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
					  <?php
					  }
					  elseif(isset($_GET["message"]) && $_GET["message"] == "Faculty ID already exist."){
					  ?>
				  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
					  <?php					
					  }
					  ?>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:5%"></th>
						  <th style="width:25%">Room Number</th>
                          <th style="width:25%">Room Type</th>
                          <th style="width:25%">Status</th>
                          <th style="width:20%">Action</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$sqlquery = "SELECT * FROM room JOIN room_type ON room.RoomTypeID=room_type.RoomTypeID WHERE room.Status!='IN-USE'";
						$res = mysqli_query($conn, $sqlquery);
						$rowStud = mysqli_fetch_array($res);
						if(mysqli_num_rows($res) == 0){
							echo "
								<tr><td colspan='3'><center>No records found.</center></td></tr>
							";
						}
						else{
						do{
						$rmnumber = $rowStud["RoomNumber"];
						$rmtypeid = $rowStud["Description"];
						$status = $rowStud["Status"];
						if($status == "UM"){
						    $status = "Under Maintenance";
						}
						?>
						<tr>
                          <td><input type="checkbox" class="checkbox" id = 'checkboxid' name="rmnum[]" value="<?php echo $rmnumber; ?>"></td>
                          <td><?php echo $rmnumber; ?></td>
                          <td><?php echo $rmtypeid; ?></td>
                          <td><?php echo $status; ?></td>
                          <td><center>
                              <button type="button" onclick="openModal1(this.id)" id="<?php echo $rmnumber; ?>" class="btn btn-round btn-success btn-sm">Update Information</button>
                          </center></td>
                         </tr>
						<?php
						}while($rowStud = mysqli_fetch_array($res));
						}
						?>
                      </tbody>
                    </table>
					</form>
					
					<br><br>
                 <button type="button" style="float:right" name="um" id="selectedum" class="btn btn-warning" disabled>Mark as Under Maintenance</button>
					<button type="submit" style="float:right" name="availale" id="selectedav" class="btn btn-success" disabled>Mark as Available</button>
					 </div>
				<br><br>
				
                </div>
				
              
		
        <!-- /page content -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
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
			  $("#selectedav").prop("disabled", false);
			  $("#selectedum").prop("disabled", false);
			  $("#selecteddel").prop("disabled", false);
		  }else{
			  $("#selectedav").prop("disabled", true);
			  $("#selectedum").prop("disabled", true);
			  $("#selecteddel").prop("disabled", true);
		  }
});

$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    } );
} );

function openModal1(id){
				$('#modal1').modal('show');
			    
			  
				$.ajax({
					url: "update_rminfo.php",
					method: "post",
					data: {
					    rmnumber: id
					},
					success: function(res){
					    $("#fld").html(res);
				        
					}
				
				});
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
                  <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="update_rminfo.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Update Room Information</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="fld"></div>
			  
			  </center>
			  	    </div>
                        <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="trans" id="sbbtn" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
				  
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

<script type="text/javascript">

	$("#selectedum").click(function(){
		var id = [];
		$("#checkboxid:checked").each(function(){
			id.push($(this).val());
		});
		$.ajax({
			type:"post",
			url:"maintenance_process.php?um",
			data:{id:id},
			success:function(data)
			{
				location.reload();
			}
		});

	});

	$("#selectedav").click(function(){
		var id = [];
		$("#checkboxid:checked").each(function(){
			id.push($(this).val());
		});
		$.ajax({
			type:"post",
			url:"maintenance_process.php?avail",
			data:{id:id},
			success:function(data)
			{
				location.reload();
			}
		});

	});
</script>