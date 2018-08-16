<?php
include("weblock.php");
?>
		<!-- page content -->
                <center><h2 style="font-size:30px">Other Amenity Rental</h2></center>
			
			    <?php
					  if(isset($_GET["messager"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["messager"]; ?></strong></center>
                  </div>
					  <?php					
					  }
					  ?>
			        <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/inventory.php');
					</script>
					
			            
			     <center><button onclick="openModalr(this.id)" type="button" id="<?php echo "other"; ?>" class="btn btn-success">Request</button></center>
			     <br><br>
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:15%">Room Number</th>
						  <th style="width:15%">Amenity</th>
						  <th style="width:10%">Hours</th>
                          <th style="width:15%">Time Start</th>
                          <th style="width:15%">Time End</th>
                          <th style="width:15%">Balance</th>
                          <th style="width:15%">Payment</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$queryr = "SELECT * FROM rentals JOIN amenity ON rentals.AmenityID=amenity.AmenityID WHERE Done='No'";
						$resr = mysqli_query($conn, $queryr);
						$rowr = mysqli_fetch_array($resr);
						if(mysqli_num_rows($resr) != 0){
						    do{
						           $idr = $rowr["RentalID"];
						           $desc = $rowr["AmenityDescription"];
						        $rmr = $rowr["RoomNumber"];
						        $hrsr = $rowr["Hours"];
						        $startr = date_format(date_create($rowr["TimeStart"]), "h:i a");
						        $endr = date_format(date_create($rowr["TimeEnd"]), "h:i a");
						        $balr = $rowr["Balance"];
						        if($balr < 0){
						            $balr = 0;
						        }
						 ?>
						        
						        <tr>
						            <td><?php echo $rmr; ?></td>
						            <td><?php echo $desc; ?></td>
						            <td><?php echo $hrsr; ?></td>
						            <td><?php echo $startr; ?></td>
						            <td><?php echo $endr; ?></td>
						            <td><?php echo $balr; ?></td>
						            <td>
						                <center>
						           <?php
						           if($balr != 0){
						           ?>
						            <button onclick="openModalxxx(this.id)" type="button" id="<?php echo $idr.";".$balr; ?>" class="btn btn-round btn-success btn-sm">Payment</button>
						            <?php
						           }
						            ?>
						            <button type="button" id="<?php echo $idr.";"."other"; ?>" onclick="cancel(this.id)" class="btn btn-round btn-danger btn-sm">Done</button>
						            </center>
						            </td>
						        </tr>
						 
						  <?php
						    }while($rowr = mysqli_fetch_array($resr));
						}
						else{
						  ?>
						  <tr>
						       <td colspan="7"><center>No records found.</center></td>
						  </tr>
						 <?php 
						}
						?>
                      </tbody>
                    </table>
					</form>
					</div>
				<br><br>
				
                </div>
                
                
                <br><br><br>    
			
				<center><h2 style="font-size:30px">KTV Rental</h2></center>
			
			    <?php
					  if(isset($_GET["message"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
					  <?php					
					  }
					  ?>
			        <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/inventory.php');
					</script>
					
			            
			     <center><button onclick="openModal(this.id)" type="button" id="<?php echo "ktv"; ?>" class="btn btn-success">Request</button></center>
			     <br><br>
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:20%">Room Number</th>
						  <th style="width:10%">Hours</th>
                          <th style="width:15%">Time Start</th>
                          <th style="width:15%">Time End</th>
                          <th style="width:20%">Balance</th>
                          <th style="width:20%">Payment</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$query = "SELECT * FROM ktv_rental WHERE Done='No'";
						$res = mysqli_query($conn, $query);
						$row = mysqli_fetch_array($res);
						if(mysqli_num_rows($res) != 0){
						    do{
						           $id = $row["KTVRentalID"];
						        $rm = $row["RoomNumber"];
						        $hrs = $row["Hours"];
						        $start = date_format(date_create($row["TimeStart"]), "h:i a");
						        $end = date_format(date_create($row["TimeEnd"]), "h:i a");
						        $bal = $row["Balance"];
						        if($bal < 0){
						            $bal = 0;
						        }
						 ?>
						        
						        <tr>
						            <td><?php echo $rm; ?></td>
						            <td><?php echo $hrs; ?></td>
						            <td><?php echo $start; ?></td>
						            <td><?php echo $end; ?></td>
						            <td><?php echo $bal; ?></td>
						            <td>
						                <center>
						           <?php
						           if($bal != 0){
						           ?>
						            <button onclick="openModalx(this.id)" type="button" id="<?php echo $id.";".$bal; ?>" class="btn btn-round btn-success btn-sm">Payment</button>
						            <?php
						           }
						            ?>
						            <button type="button" id="<?php echo $id.";"."ktv"; ?>" onclick="cancel(this.id)" class="btn btn-round btn-danger btn-sm">Done</button>
						            </center>
						            </td>
						        </tr>
						 
						  <?php
						    }while($row = mysqli_fetch_array($res));
						}
						else{
						  ?>
						  <tr>
						       <td colspan="6"><center>No records found.</center></td>
						  </tr>
						 <?php 
						}
						?>
                      </tbody>
                    </table>
					</form>
					</div>
				<br><br>
				
                </div>
                
                
                <br><br><br>
                
                <center><h2 style="font-size:30px">Billiards Rental</h2></center>
			
			    <?php
					  if(isset($_GET["messagex"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["messagex"]; ?></strong></center>
                  </div>
					  <?php					
					  }
					  ?>
			        
					
			            
			     <center><button onclick="openModal(this.id)" type="button" id="<?php echo "billiards"; ?>" class="btn btn-success">Request</button></center>
			     <br><br>
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
						  <th style="width:20%">Room Number</th>
						  <th style="width:10%">Hours</th>
                          <th style="width:15%">Time Start</th>
                          <th style="width:15%">Time End</th>
                          <th style="width:20%">Balance</th>
                          <th style="width:20%">Payment</th>
                        </tr>
                      </thead>	

                      <tbody>
						<?php
						include("php_connect.php");
						$queryx = "SELECT * FROM billiards_rental WHERE Done='No'";
						$resx = mysqli_query($conn, $queryx);
						$rowx = mysqli_fetch_array($resx);
						if(mysqli_num_rows($resx) != 0){
						    do{
						           $idx = $rowx["BilliardRentalID"];
						        $rmx = $rowx["RoomNumber"];
						        $hrsx = $rowx["Hours"];
						        $startx = date_format(date_create($rowx["TimeStart"]), "h:i a");
						        $endx = date_format(date_create($rowx["TimeEnd"]), "h:i a");
						        $balx = $rowx["Balance"];
						        if($balx < 0){
						            $balx = 0;
						        }
						 ?>
						        
						        <tr>
						            <td><?php echo $rmx; ?></td>
						            <td><?php echo $hrsx; ?></td>
						            <td><?php echo $startx; ?></td>
						            <td><?php echo $endx; ?></td>
						            <td><?php echo $balx; ?></td>
						            <td>
						                <center>
						           <?php
						           if($balx != 0){
						           ?>
						            <button onclick="openModalxx(this.id)" type="button" id="<?php echo $idx.";".$balx; ?>" class="btn btn-round btn-success btn-sm">Payment</button>
						            <?php
						           }
						            ?>
						            <button type="button" id="<?php echo $idx.";"."billiard"; ?>" onclick="cancel(this.id)" class="btn btn-round btn-danger btn-sm">Done</button>
						            </center>
						            </td>
						        </tr>
						 
						  <?php
						    }while($rowx = mysqli_fetch_array($resx));
						}
						else{
						  ?>
						  <tr>
						       <td colspan="6"><center>No records found.</center></td>
						  </tr>
						 <?php 
						}
						?>
                      </tbody>
                    </table>
					</form>
					</div>
				<br><br>
				
                </div>
				
              
		
        <!-- /page content -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>	
		<script type="text/javascript">

function openModal(id){
            //token the id;
            //id;amttopay
               
				$('#modal').modal('show');
			$("#subbtn").attr("name", id);
				
					$.ajax({
					url: "rooms.php",
					method: "post",
					success: function(res){
                        $("#avroom").html(res);				            
				    }
				});
			 	
			}

function openModalr(id){
            //token the id;
            //id;amttopay
               
				$('#modalr').modal('show');
			$("#subbtnr").attr("name", id);
				
					$.ajax({
					url: "rooms.php",
					method: "post",
					success: function(res){
                        $("#avroomr").html(res);				            
				    }
				});
			 	
			}
			
function openModalx(id){
            //token the id;
            //id;amttopay
            var res = id.split(";");
            
				$('#modalx').modal('show');
				$("#resmod").val(res[0]);
				$("#amtToPay").val(parseFloat(res[1]).toFixed(2));
			    $("#amtrendered").attr("min", parseFloat(res[1]));
				
			}
			
function amenityMod(){
    	$('#amenity').modal('show');
}
			
function openModalxx(id){
            //token the id;
            //id;amttopay
            var res = id.split(";");
            
				$('#modalxx').modal('show');
				$("#resmodx").val(res[0]);
				$("#amtToPayx").val(parseFloat(res[1]).toFixed(2));
			    $("#amtrenderedx").attr("min", parseFloat(res[1]));
				
			}
			
function openModalxxx(id){
            //token the id;
            //id;amttopay
            var res = id.split(";");
            
				$('#modalxxx').modal('show');
				$("#resmodxx").val(res[0]);
				$("#amtToPayxx").val(parseFloat(res[1]).toFixed(2));
			    $("#amtrenderedxx").attr("min", parseFloat(res[1]));
				
			}

function cancel(id){
    
    var res = id.split(";"); 
    
swal({
  title: "Are you sure?",
  text: "Are you sure you want to mark this rental as done?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, proceed!",
  closeOnConfirm: false
},
function(isConfirm) {
	if (isConfirm) {
			$.ajax({
				url: "done.php",
				method: "post",
				data: {
					id: res[0],
					type: res[1]
				},
				success: function(res){
				    if(res == "ktv"){
					window.location.href="inventory.php?message=Rental successfully marked as done.";
				    }
				    else if(res == "other"){
				    window.location.href="inventory.php?messager=Rental successfully marked as done.";
				    }
				    else{
				    window.location.href="inventory.php?messagex=Rental successfully marked as done.";
				    }
				}
			});
		}
		else{
			return false;
		}
    });
}			
			
			</script>

 <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="charges.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Request</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <div id="messin" style="font-size:15px; font-weight: bold">Rooms:</div>
			  <div id="avroom">

              </div>
              <div id="messin" style="font-size:15px; font-weight: bold">Hours:</div>
              <div>
                  <input type="number" max="24" style='width:70%' min="1" value="1" name="hours" required>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <input type="text" id="resmod1" hidden readonly name="resid">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="trans" id="subbtn" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal fade bs-example-modal-lg" id="modalr" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="charges.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Request</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
              <div id="messin" style="font-size:15px; font-weight: bold">Amenity:</div>
              <div>
                  <select name="amenity" required style="width:100%">
                      <?php
                      //get all in amenities
                      $amen = "SELECT * FROM amenity";
                      $resamen = mysqli_query($conn, $amen);
                      $rowamen = mysqli_fetch_array($resamen);
                      if(mysqli_num_rows($resamen) > 0){
                          do{
                              $aid = $rowamen["AmenityID"];
                              $dsc = $rowamen["AmenityDescription"];
                              $amt = $rowamen["HourlyRate"];
                    ?>
                            <option value="<?php echo $aid; ?>"><?php echo $dsc." - ".$amt."/hour"; ?></option>
                    <?php
                          }while($rowamen = mysqli_fetch_array($resamen));
                      }
                      else{
                    ?>
                        <option value="">No amenity available.</option>
                    <?php
                      }
                      ?>
                  </select>
              </div>
			  <br>
			  
			  <div id="messin" style="font-size:15px; font-weight: bold">Rooms:</div>
			  <div id="avroomr">
        
              </div>
                <br>
              <div id="messin" style="font-size:15px; font-weight: bold">Hours:</div>
              <div>
                  <input type="number" max="24" style='width:70%' min="1" value="1" name="hours" required>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <input type="text" id="resmod1" hidden readonly name="resid">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="trans" id="subbtnr" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal fade bs-example-modal-lg" id="modalx" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="payment.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"></h4>Payment</h4>
                        </div>
                        <div class="modal-body">
                <center>
             <div id="messin" style="font-size:15px; font-weight: bold">Amount to Pay:  </div>
			  <div>
                <input type="number" name="amttopayx" id="amtToPay" class="form-control" readonly style="width:70%" min="1000"/>
              </div>
			  <br><br>
              <div id="messin" style="font-size:15px; font-weight: bold">Rendered Amount:</div>
			  <div>
				<input type="text" id="resmod" hidden readonly name="resid">
                <input type="number" name="amtrendered" id="amtrendered" class="form-control" placeholder="0.00" required="" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="payCharges" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>

               
                  <div class="modal fade bs-example-modal-lg" id="modalxx" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="payment.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"></h4>Payment</h4>
                        </div>
                        <div class="modal-body">
                <center>
             <div id="messin" style="font-size:15px; font-weight: bold">Amount to Pay:  </div>
			  <div>
                <input type="number" name="amttopayx" id="amtToPayx" class="form-control" readonly style="width:70%" min="1000"/>
              </div>
			  <br><br>
              <div id="messin" style="font-size:15px; font-weight: bold">Rendered Amount:</div>
			  <div>
				<input type="text" id="resmodx" hidden readonly name="resid">
                <input type="number" name="amtrendered" id="amtrenderedx" class="form-control" placeholder="0.00" required="" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="payChargesx" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal fade bs-example-modal-lg" id="modalxxx" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
					<form id="respay" data-parsley-validate class="form-horizontal form-label-left" method="post" action="payment.php">
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"></h4>Payment</h4>
                        </div>
                        <div class="modal-body">
                <center>
             <div id="messin" style="font-size:15px; font-weight: bold">Amount to Pay:  </div>
			  <div>
                <input type="number" name="amttopayx" id="amtToPayxx" class="form-control" readonly style="width:70%" min="1000"/>
              </div>
			  <br><br>
              <div id="messin" style="font-size:15px; font-weight: bold">Rendered Amount:</div>
			  <div>
				<input type="text" id="resmodxx" hidden readonly name="resid">
                <input type="number" name="amtrendered" id="amtrenderedxx" class="form-control" placeholder="0.00" required="" style="width:70%"/>
              </div>
			  <br>
			  </center>
			  	    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button type="submit" name="payChargesxx" onclick="" class="btn btn-primary">Submit</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
