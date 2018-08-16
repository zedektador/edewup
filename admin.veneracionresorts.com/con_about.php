<?php
include("weblock.php");
if(isset($_POST['saveAbt']))
{
    $newAbout=$_POST['aboutEdit'];
    $updateQry = "UPDATE about set AboutUS='$newAbout'";
	mysqli_query($conn, $updateQry);
    header('Location: about.php?msgsuccess="1"');
	
}

?>
		<!-- page content -->
        
			
			
			
				<center><h2 style="font-size:30px">About</h2></center>
					  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
			    	<script>
						history.pushState(null, '', '/about.php');
					</script>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:40%">About Message</th>
                          <th style="width:5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
						<tr>
							<td>
								<?php 
									$abt = "SELECT * FROM about";
									$resabt = mysqli_query($conn, $abt);
									$rowabt = mysqli_fetch_array($resabt);
									echo $rowabt["AboutUS"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal(this.id)" id="1" class="btn btn-round btn-success btn-sm">Edit</button>
							</td>
						</tr>
                      
						
                      </tbody>
                    </table>
					</form>
                  </div>
				
				
                </div>
				
              
		
		
		<?php
		
		?>
        <!-- /page content -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
		<script type="text/javascript">
			function openModal(id){
				$('#modal').modal('show');
				$("#resmod").val(id);
			}

			var rmtrans = "";

			
		function openModal1(id){
				$('#modal1').modal('show');
				$("#resmod1").val(id);
				
				
				
				//get current room
				$.ajax({
					url: "transfer.php",
					method: "post",
					data: {
						rmnumber : id
					},
					success: function(res){
					    if(res == "meron"){
					        swal("Validation", "You can only transfer once", "warning");
					        $('#modal1').modal('hide');
					    }
					    else{
					 $("#avroom").html(res);
					 //alert(res);

rmtrans = $("#rmavail").val();
$.ajax({
	url: "transfer.php",
	method: "post",
	data: {
		rmdet: "la lang",
		rmnum: rmtrans
	},
	success: function(res){
		$("#rmdet").html(res);
	}
});
				
					    }
				
					}
				
				});
			}
			
function chgdet(){
rmtrans = $("#rmavail").val();
$.ajax({
	url: "transfer.php",
	method: "post",
	data: {
		rmdet: "la lang",
		rmnum: rmtrans
	},
	success: function(res){
		$("#rmdet").html(res);
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

function validate(){
	var ren = parseFloat($("#ren").val());
	var total = <?php
		if(isset($finalbill)){
			echo $finalbill;
		}
		else{
			echo 0;
		}
	?>;
	
	if(ren < total){
		swal("Validation", "The rendered amount should be greater than the actual payment to settle.", "warning");
		return false;
	}
	else{
		return true;
	}
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
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="con_about.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Edit About</h4>
                        </div>
                        <div class="modal-body">
                <center>
            <textarea name="aboutEdit" style="resize:none" cols="50" rows="20" width="100%">
			        <?php 
						$abt = "SELECT * FROM about";
						$resabt = mysqli_query($conn, $abt);
						$rowabt = mysqli_fetch_array($resabt);
						echo $rowabt["AboutUS"];
					?>	
			      </textarea>
              
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="saveAbt" id="svabt" class="btn btn-primary">Save</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
				  
				  <!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="con_about.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Remove About Us</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Are you sure you want to remove about us message?</div>
			  </center>
			  	    </div>
                        <div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						  <button type="submit" name="delAbt" id="" class="btn btn-primary">Yes</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
		
		
<script>

$.ajax({
	url: "additional.php",
	method: "post",
	success: function(res){
		var br = res.split("#");
		$("#additional").html(br[1]);
		$("#misc").val(br[0]);
	}
}); 


//triggers on select change
function chg(){
	//bring back quantity to 1
	$("#quan").val(1);
	
	//show amount of the additional selected
	var addid = $("#addsel").val();
	$.ajax({
		url: "additional.php",
		method: "post",
		data: {
			addid:addid
		},
		success: function(res){
			$("#misc").val(res);
		}
	});
}


//for room details




	
		</script>
</script>