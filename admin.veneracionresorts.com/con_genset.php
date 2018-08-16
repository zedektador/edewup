<?php
include("weblock.php");
?>

                <center><h2 style="font-size:30px">General Settings</h2></center>

                    <?php
					  if(isset($_GET["message"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
					<script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/genset.php');
					</script>
                  </div>
					  <?php
					  }
				?>
				
				
				<div class="x_panel">
                  <div class="x_content" style="height:750px">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th style="width:40%">Settings</th>
						  <th style="width:40%">Value</th>
                          <th style="width:20%">Action</th>
                        </tr>
                      </thead>	
						<?php 
							$query = "SELECT * FROM settings";
							$res = mysqli_query($conn, $query);
							$row = mysqli_fetch_array($res);			
						?>	 
						<tr>
							<td>Max Guest</td>
							<td>
								<?php 
									echo $row["MaxGuest"];
								?>	 
							</td>
							<td>
							    <?php
							    //EIRON Step 1:
							    /*
							        ito yung button na magtatawag ng modal.
							        yung id ginawa ko lang na gantong format:
							            palatandaan;valueNaGalingSaDB
							            ---> <?php echo "maxguest;".$row["MaxGuest"]; ?>
							            
							        so bali onclick tatawagin nya si openModal1 na function -> proceed to EIRON Step 2:
							    */
							    ?>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "maxguest;".$row["MaxGuest"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							
							</td>
						</tr>
						<tr>
							<td>Max Reservation Days</td>
							<td>
								<?php 
									echo $row["MaxReservationDays"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "MaxReservationDays;".$row["MaxReservationDays"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Account Name</td>
							<td>
								<?php 
									echo $row["AccountName"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "AccountName;".$row["AccountName"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Account Number</td>
							<td>
								<?php 
									echo $row["AccountNumber"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "AccountNumber;".$row["AccountNumber"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Standard In</td>
							<td>
								<?php 
									echo $row["StandardIn"];
								?>	 
							</td>
							<td>
									<button type="button" onclick="openModal1(this.id)" id="<?php echo "StandardIn;".$row["StandardIn"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Standard Out</td>
							<td>
								<?php 
									echo $row["StandardOut"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "StandardOut;".$row["StandardOut"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>KTV Price (per 2 Hours)</td>
							<td>
								<?php 
									echo number_format($row["KTVPricePer2Hours"],2);
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "KTV;".$row["KTVPricePer2Hours"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Billiards Price (per Hour)</td>
							<td>
								<?php 
									echo number_format($row["BilliardsPricePerHour"],2);
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "Billiard;".$row["BilliardsPricePerHour"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						
						<tr>
							<td>Jacuzzi Price</td>
							<td>
								<?php 
									echo number_format($row["JacuzziPrice"],2);
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "Jacuzzi;".$row["JacuzziPrice"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Mattress Price</td>
							<td>
								<?php 
									echo number_format($row["MattressPrice"],2);
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "Mattress;".$row["MattressPrice"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						
						<tr>
							<td>Contact Number</td>
							<td>
								<?php 
									echo $row["ContactNumber"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "Number;".$row["ContactNumber"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
						<tr>
							<td>Email Address</td>
							<td>
								<?php 
									echo $row["EmailAddress"];
								?>	 
							</td>
							<td>
								<button type="button" onclick="openModal1(this.id)" id="<?php echo "Email;".$row["EmailAddress"]; ?>" class="btn btn-round btn-success btn-sm">Update</button>
							</td>
						</tr>
                      <tbody>
						
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

			
		//EIRON: dun ka na lang sa settinsg_ajax.php magbabago.. 	
		
		//EIRON Step 2:
		/*
		    ito yung function na tinatawag nya.
		    so si ID diba since andun sa code sa step 1 na maxGuest;ID
		    so dito sya sa loob ng function hahatiin
		    see Step 3 below
		*/
		function openModal1(id){
				$('#modal1').modal('show');
			    //get value and field
			    
			    
			   //Step 3:
			   /*
			   so si id na parameter isplit. si split ang ginagawa nya hatiin yung string depende dun sa delimiter. ang sinet kong delimiter sa function na split is ; kaya yung value ni id nahati sa dalawa . si res[0] -> maxGuest at si res[1] -> ID
			        array ang nirereturn ni split
			        
			        proceed to Step 4:
			   */
			   var res = id.split(";");
			   var fieldx = res[0];
			   var valx = res[1];
			
			
			    //Step 4:
			    /*
			        ito yung ajax na tinatawag.
			        so bali si ajax hahanapin nya ung url, method, data, and success.
			        si url ito ung file na tatawagin mo
			        si data yan ung kumbaga sa post yan ung laman na values. yung nasa right side yan ung actual value na iseset mo
			            yung nasa left side yun ung tatawagin mo sa page as $_POST variable.
			            halimbawa si fieldx na right sya ung nakadeclare sa taas na fieldx = res[0] tas si fieldx sa lft dun mo sinasave ung data ni fieldx bali kapag inaccess mo sya dun sa page S_POST['fieldx']
			            so sa sample na to, dalawa yung variables na ipapasa ko sa next page (settings_ajax.php) 
			            NOTE: be careful sa paggamit ng comma (,) check mo kung pano ginawa ko dyan. :D kapag wala ng kasunod na variable wala ng comma 
			            si success naman sya yung gagawin ni ajax pag naexecute nya na ung codes dun sa url(page) na tinawag mo.
			            kaya sya ajax kase nagfafunction sya like sa POST ng hindi mo nirereload ung page.
			            si res na nasa loob ng success:function() maiintindihan mo sa next step. 
			            see Step 5 sa settings_ajax.php
			    */
				//get current room
				$.ajax({
					url: "settings_ajax.php",
					method: "post",
					data: {
						fieldx: fieldx,
						valx: valx 
					},
					success: function(res){
					    //Step 6:
					    /*
					        diba dun sa php file nakita mong may nakaecho na input box, so sya ngayon ung laman ni res 
					        ang ginawa ko ung div na may fld dun sa modal sa taas inilagay ko sa loob nya ung input box na nakapaloob kay res variable.
					        tapos si sbbtn na button sa modal din pinalitan ko ng name na nakabase dun sa field na binabago ko.. feel k di mo naman need to. ginawa ko lang to para dun sa saving alam nya kung anong field ung ineedit kase nakadepende diba sa name ni submit btn ung corresponding action na gagawin nya.
					        so ayun na nga inexecute na ni jquery tong mga codes na to . see Step 7 para makita mo kung san nagtake effect ung codes sa baba.
					    */
					    $("#fld").html(res);
				        $("#sbbtn").attr("name", fieldx);
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
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="con_genset.php">
					
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
						  <button type="submit" name="update" id="chrge" class="btn btn-primary">Update</button>
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
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="settings_ajax.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Update Settings</h4>
                        </div>
                        <div class="modal-body">
                <center>
              <?php
              //Step 7:
              /*
              ito yung fld na div, dito sa loob nya ilalagay ung input box na inecho ka galing dun sa ajax.
              then ayun tapos na :D HAHAHAHAHAHHAHA
              */
              ?>
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
		
		

	
</script>