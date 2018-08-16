<?php
include("weblock.php");
if(isset($_POST['generate2']))
{
    $name=$_SESSION['name'];
    $type=$_POST['reporttypee'];
    $start=$_POST['start'];
    $end=$_POST['end'];
	echo '<script type="text/javascript" language="Javascript">window.open("reports.php");</script>';
    echo '<script type="text/javascript" language="Javascript">window.open("printReport.php?type='.$type.'&start='.$start.'&end='.$end.'&name='.$name.'");</script>';
    echo '<script type="text/javascript" language="Javascript">window.close();</script>';
}
?>
<script>
function validate2() 
    {
        var reporttypee = document.forms["index2"]["reporttypee"].value;
        if (reporttypee == "-Select Type Of Report-") 
        {
            alert("Please select Report Type.");
            return false;
        }
    	
    	var start = document.forms["index2"]["start"].value;
        if (start == "") 
        {
            alert("Please select Start Date.");
            return false;
        } 
        else if (start > end) 
        {
            alert("Invalid Date: Start Date is greater than End Date.");
            return false;
    	}
    	var end = document.forms["index2"]["end"].value;
        if (end == "") 
        {
            alert("Please select End Date.");
            return false;
        } 
        else if (end < start) 
        {
            alert("Invalid Date: End Date is greater than Start Date.");
            return false;
    	}
    }
  </script>
		<!-- page content -->
        
			
			
			
				<center><h2 style="font-size:30px">Reports</h2></center>
					  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
					//	history.pushState(null, '', '/reports.php');
					</script>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="con_reports.php" method="post" name="index2">
					    <div class="col-md-12">
							<div class="form-group" name="index2">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseActive2" aria-expanded="true">
									<label>Date Ranged Reports:</label>
								</a>
								<div id="collapseActive2" class="panel-collapse collapse in" aria-expanded="true" style="">
									<select class="form-control" name="reporttypee">
										<option>-Select Type Of Report-</option>
										<option>All Reservation Report</option>
										<option>Confirmed Reservation Report</option>
										<option>Cancelled Reservation Report</option>
										<option>Pending Reservation Report</option>
										<option>Sales Report</option>
										<option>Check-in Report</option>
									</select>
				
						<br>
			   
						<div class="col-md-6">
							<div class="form-group" name="index2">
								<label>Start Date:</label>
								<input type="date" name="start" class="form-control" value="<?php echo date('Y-m-d', strtotime('-7 days')) ?>"/>
								
							</div>
						</div>
						<div class="col-md-6">
						<div class="form-group" name="index2">
						<label>End Date:</label>
						<input type="date" name="end" class="form-control" value="<?php echo date('Y-m-d'); ?>">
						</div>
						</div>
						<div class="col-md-12" align="right"> 
							<button type="reset" class="btn btn-warning">Reset</button>			
							<button onclick="return validate2();" type="submit" name="generate2" class="btn btn-success">Generate Report</button>
						</div>
							 </div>
						</div>
						
						</div>
						&nbsp;
						
					</form>
                  </div>
                </div>
						
				
              
		
		
		
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
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="additional.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Additional Charges</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Additional:</div>
			  <div id="additional">

              </div>
			  <br><br>
			  <div id="messin" style="font-size:15px; font-weight: bold">Quantity:</div>
			  <div>
				<input type="text" id="resmod" hidden readonly name="resid">
                <input type="number" name="quan" id="quan" class="form-control" value="1" required="" style="width:50%" min="1"/>
              </div>
			  <br><br>
			  <div id="messin" style="font-size:15px; font-weight: bold">Amount per Day:</div>
			  <div>
				<input type="number" name="misc" id="misc" class="form-control" required="" style="width:50%" min="1" readonly/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="charge" id="chrge" class="btn btn-primary">Submit</button>
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
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="transfer.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Room Transfer</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Available Rooms:</div>
			  <div id="avroom">

              </div>
			  <br><br>
			  <div id="rmdet"></div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <input type="text" id="resmod1" hidden readonly name="resid">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="trans" id="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
		
		

	
</script>