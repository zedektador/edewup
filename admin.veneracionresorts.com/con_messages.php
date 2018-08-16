<?php
include("weblock.php");
?>
		<!-- page content -->
       
			
			
				<center><h2 style="font-size:30px">Clients Messages</h2></center>
				
						<?php
					  if(isset($_GET["message"]) && ($_GET["message"] == "Message successfully marked as read" || $_GET["message"] == "Message successfully sent.")){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
				  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/messages.php');
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
						  <th style="width:15%">Name</th>
                          <th style="width:15%">Contact Number</th>
						<th style="width:15%">Subject</th>
						<th style="width:35%">Message</th>
                          <th style="width:20%">Action</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$sqlquery = "SELECT * FROM messages WHERE Replied='NO'";
						$res = mysqli_query($conn, $sqlquery);
						$rowStud = mysqli_fetch_array($res);
						if(mysqli_num_rows($res) == 0){
							echo "
								<tr><td colspan='5'><center>No records found.</center></td></tr>
							";
						}
						else{
						do{
						$pid = $rowStud["MessageID"];
						$name = $rowStud["Name"];
						$cn = $rowStud["ContactNumber"];
						$subj = $rowStud["Subject"];
						$msg = $rowStud["Message"];
						?>
						<tr>
                         <td style="padding-top:20px;padding-bottom:20px">
                             <?php echo $name; ?>
					</td>
					      <td><?php echo $cn; ?></td>
                          <td><?php echo $subj; ?></td>
                           <td><?php echo $msg; ?></td>
                          <td><center>
						<button onclick="openModal(this.id)"  type="button" id="<?php echo $pid; ?>" class="btn btn-round btn-success btn-sm">Reply</button>
						  <button type="button" onclick="read(this.id)" id="<?php echo $pid; ?>" class="btn btn-round btn-danger btn-sm">Delete</button>
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
		
		
		function read(id){
swal({
  title: "Are you sure?",
  text: "Do you want to mark this message as read?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, please!",
  closeOnConfirm: false
},
function(isConfirm) {
	if (isConfirm) {
			$.ajax({
				url: "read.php",
				method: "post",
				data: {
					id: id
				},
				success: function(res){
					window.location.href="messages.php?message=Message successfully marked as read";
				}
			});
		}
		else{
			return false;
		}
    });
}

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

 
function openModal(id){
				$('#modal').modal('show');
				$("#resmod").val(id);
			}
			
 
function openModalCon(id){
                var res = id.split(";");
                var idx = res[0];
                var amt = res[1];
				$('#modalConfirm').modal('show');
				$("#resmodConfirm").val(idx);
				$("#amtpaid").attr("min", amt);
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
						  <button type="submit" name="msgx" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					 </form>
					 </div>
                    </div>
                  </div>
				  <!-- Large modal -->
				  
				  
