<?php
include("weblock.php");
?>
		<!-- page content -->
       
				<center><h2 style="font-size:30px">Amenity Management</h2>
						
			<button type="button" style='width:250px' onclick="amenityMod()" name="upload-modal-trig" class="btn btn-success btn-block">Add Amenity</button></center>
				<br>
						<?php
					  if(isset($_GET["message"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
				  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/amenities.php');
					</script>
					  <?php
					  }
					?>
					
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:40%">Amenity Description</th>
                          <th style="width:30%">Hourly Rate</th>
                          <th style="width:30%">Action</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$sqlquery = "SELECT * FROM amenity";
						$res = mysqli_query($conn, $sqlquery);
						$rowStud = mysqli_fetch_array($res);
						if(mysqli_num_rows($res) == 0){
							echo "
								<tr><td colspan='3'><center>No records found.</center></td></tr>
							";
						}
						else{
						do{
						   $desc = $rowStud["AmenityDescription"];
						   $id = $rowStud["AmenityID"];
						   $rate = $rowStud["HourlyRate"];
						?>
						<tr>
                            <td><?php echo $desc; ?></td>
                          <td><?php echo number_format($rate, 2); ?></td>
                           <td><center>
						<button value = '<?php echo $desc.";".$id; ?>' id = 'btnDelete'  type="button" class="btn btn-round btn-warning btn-sm">Delete</button>
						  <button type="button" onclick="openModalCon(this.id)" id="<?php echo $id; ?>"class="btn btn-round btn-success btn-sm">Edit</button>
						  </center></td>
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
				
              
		
        <!-- /page content -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
		<script type="text/javascript">
			function surecon(id){
			
			swal({
  title: "Confirm this?",
  text: "Does the amount indicated in the slip match the given amount?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(isConfirm) {
        if (isConfirm) {
			
			$.ajax({
				url: "confirmpayment.php",
				method: "post",
				data:{
					id:id
				},
				success: function(){
					window.location.href="lbc_payments.php?message=Successfully recorded payment.";
				}
			});
        } else {
            return false;
        }
    }
);
			}
	
			
			function openModal1(id){
				$('#modal1').modal('show');
				//ajax for image
				$.ajax({
					url: "image.php",
					method: "post",
					data:{
						id:id
					},
					success: function(data){
						$("#lbcslip").html(data);
					}
				});
				
			}
		
//Confirmation delete
	$(document).on("click","#btnDelete",function(){
		$("#Modal_Delete").modal('show');
		var user = $(this).val();
		var res = user.split(";");
		$("#name_del").text(res[0]);
		$("#AccUser").val(res[1]);
		//alert(user);
	});	

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

$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    } );
} );


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
				
		
<script>
 $("#fid").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
	 }
 });

function amenityMod(){
    $('#amenity').modal('show');
}
 
function openModal(id){
				$('#modal').modal('show');
				$("#resmod").val(id);
			}
			
 
function openModalCon(id){
                $('#amenityEdit').modal('show');
                $("#amid").val(id);
        
        	$.ajax({
				url: "amenity_ajax.php",
				method: "post",
				data:{
					id:id
				},
				success: function(res){
				    
				    //echo $row["AmenityDescription"].";".$row["HourlyRate"];
				    var ress = res.split(";");
				    var desc = ress[0];
				    var rate = ress[1];
				    
					$("#desc").val(desc);
					$("#rate").val(rate);
				}
			});
			
			}
			
			
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
	
		</script>
</script>

<div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:50%">
                      <div class="modal-content">
					
                  <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Bank Slip</h4>
                        </div>
                        <div class="modal-body">
							<div id="lbcslip"></div>
						</div>
                      </div>
                  </div>
				  </div></div>
				  
				  
				  <div class="modal fade bs-example-modal-lg" id="modalConfirm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form action="confmessage.php" method="post">
				 <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Amount Indicated:</div>
			  <div>
				<input type="text" name="lbcid" id="resmodConfirm" hidden>
			    <input type="number" name="amtpaid" id="amtpaid" min="1" max"1000000" required>
			  </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="pay" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					 </form>
					 </div>
                    </div>
                  </div>
                  
				  
				  <!-- Large modal -->      
					
                  <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form action="message.php" method="post">
				 <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Message</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Insert Message Here:</div>
			  <div>
				<input type="text" name="lbcid" id="resmod" hidden>
			  <textarea name="msg" rows="10" class="form-control" required style="width:90%; resize:none;">
				</textarea>
			  </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="pay" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					 </form>
					 </div>
                    </div>
                  </div>
				  <!-- Large modal -->
				  
				  
				   <div class="modal fade bs-example-modal-lg" id="amenity" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="add_amenity.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"></h4>Add Amenity</h4>
                        </div>
                        <div class="modal-body">
                <center>
             <div id="messin" style="font-size:15px; font-weight: bold">Amenity Description:  </div>
			  <div>
                <input type="text" name="amenity" required class="form-control" style="width:70%" maxlength="50" placeholder="Amenity Description"/>
              </div>
			  <br><br>
              <div id="messin" style="font-size:15px; font-weight: bold">Hourly Rate:</div>
			  <div>
				<input type="number" name="rate" class="form-control" placeholder="0.00" required="" min="1" max="1000000" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="amenityadd" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal fade bs-example-modal-lg" id="amenityEdit" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="add_amenity.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"></h4>Edit Amenity</h4>
                        </div>
                        <div class="modal-body">
                <center>
             <div id="messin" style="font-size:15px; font-weight: bold">Amenity Description:  </div>
			  <div>
			      <input type="text" name="id" id="amid" required hidden />
                <input type="text" name="amenity" required class="form-control" style="width:70%" maxlength="50" id="desc" placeholder="Amenity Description"/>
              </div>
			  <br><br>
              <div id="messin" style="font-size:15px; font-weight: bold">Hourly Rate:</div>
			  <div>
				<input type="number" name="rate" class="form-control" placeholder="0.00" required="" id="rate" min="1" max="1000000" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="amenityedit" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_Delete">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="add_amenity.php" method="post">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Delete <i class = "fa fa-question-circle"></i></h4>
                        </div>
                        <div class="modal-body">
                          <h5>Are you sure you want to delete  <span id = "name_del"></span> ?</h5>
                          <input type ="hidden" name="id" id = "AccUser" >
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" name="del" class="btn btn-danger">Delete</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
