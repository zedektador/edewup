<?php
include("weblock.php");
if(isset($_GET['delID']))
{
    $id=$_GET['delID'];
    mysqli_query($conn, "DELETE from gallery WHERE PicID=$id");
    header('Location: galle.php?delmsg=scsdltd');
}
?>
		<!-- page content -->

<!-- lined-icons -->

<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
                <?php
                if(isset($_GET['delmsg']))
                {
                    echo '<script type="text/javascript">swal("Success", "Successfully deleted!", "success")</script>';
                }
                if(isset($_GET['upscs']))
                {
                    echo '<script type="text/javascript">swal("Success", "Upload complete!", "success")</script>';
                }
                if(isset($_GET['upfld']))
                {
                    echo '<script type="text/javascript">swal("Upload failed", "File size too big.", "error")</script>';
                }
                
                ?>
			
				<center><h2 style="font-size:30px">Gallery</h2></center>
					  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/galle.php');
					</script>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<form action="update_fac.php" method="post">
                        <div align="right">
							<button type="button" onclick="uploadModal(this.id)" name="upload-modal-trig" class="btn btn-primary btn-block">Upload</button>
						</div>
                    <table class="table table-hover">
                        
                      <thead>
                        <tr>
                          <th style="width:30%">Picture ID</th>
						  <th style="width:40%">Picture</th>
                          <th style="width:30%">Action</th>
                        </tr>
                      </thead>	
						
                      <tbody>
                          <?php 
								$q = "SELECT * FROM gallery";
								$res = mysqli_query($conn, $q);
								while($row = mysqli_fetch_array($res)){
								$iID=$row['PicID'];
								$pic=$row['Image'];
								$msg='';
								$msg1='';
								$msg2="";
							?>	 
						<tr>
							<td><?php echo $iID ?></td>
							<td>
							<?php
							    if(!empty($pic))
							    {
							        echo '<img style="height:180px; width:300px;" src="data:image/jpeg;base64,'.base64_encode( $pic ).'"/>'; 
							        $msg="disabled";
							    }
							    else
							    {
							        echo 'Upload picture. . .';
							        $msg1="class='disabled'";
							        $msg2="disabled";
							    }
							?>
							</td>
							
							<td>
								<button type="button" onclick="openModalSamp(this.id)" id=galleview;"<?php echo $iID ?>" class="btn btn-round btn-success btn-sm">View</button>
								<a href="con_galle.php?delID=<?php echo $iID ?>"><button type="button" class="btn btn-round btn-success btn-sm">Remove</button></a>
							</td>
						</tr>
						
						<?php
								}
						?>
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
			function openModalSamp(id){
				$('#modal').modal('show');
				$("#resmod").val(id);
			}

			var rmtrans = "";

			
		function openModalSamp(id){
				$('#modal1').modal('show');
				
			    var res = id.split(";");
			    var view_or_upload = res[0];
			    var picIDs = res[1];
				
				
				//get current room
				$.ajax({
					url: "picCar_ajax.php",
					method: "post",
					data: {
						picID: picIDs,
						action: view_or_upload
						
					},
					success: function(res){
					   
					 $("#shows").html(res);
					 
				
					}
				
				});
			}
			function uploadModal(id){
				$('#modal-upload').modal('show');
			}

			



		</script>
				<!-- Large modal -->
                  
				  <!-- Large modal -->
				  
				  <!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                        <div class="modal-content">
					        <form data-parsley-validate class="form-horizontal form-label-left" method="post" action="transfer.php">
    					    <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">Picture</h4>
                            </div>
                            <div class="modal-body">
                            <center>
			                <div id="shows">
			                    <!--DATA FROM AJAX-->
			                </div>
			                </center>
			  	            </div>
                            <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
					        </form>
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
				  
		           <div class="modal fade bs-example-modal-lg" id="modal-upload" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                        <div class="modal-content">
    					    <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">Upload Picture</h4>
                            </div>
                            <div class="modal-body">
                            <center>
			                <div id="shows">
			                    <form action="uploadCar.php" method="post" enctype="multipart/form-data">
                                <div class="picture">
                                   <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" required>
                                </div>
                                <div class="submit">
                                  <input type="submit" name="uploadgalle" value="Upload"  />
                                </div>
                                </form>
			                </div>
			                </center>
			  	            </div>
                            <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
					        
                      </div>
                    </div>
                  </div>
		
		

	
</script>