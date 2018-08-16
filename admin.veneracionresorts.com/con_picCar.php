<?php
include("weblock.php");
if(isset($_GET['delID']))
{
    $id=$_GET['delID'];
    mysqli_query($conn, "DELETE FROM slide where SlideID=$id");
    header('Location: picCar.php?delmsg=1');
}
?>
		<!-- page content -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
		.disabled 
		{
            pointer-events: none;
            cursor: default;
        }
		</style>
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
				<center><h2 style="font-size:30px">Picture Carousel</h2></center>
					  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/picCar.php');
					</script>
				
				
				<div class="x_panel">
                  <div class="x_content">
					<div align="right">
					    <?php
					        $msg='';
							$res = mysqli_query($conn, "SELECT * FROM slide");
					        $cnt=mysqli_num_rows($res);
					        if($cnt >= 6)
					        {
					            $msg="disabled";
					        }
					    ?>
					    <button type="button" onclick="openModalSamp(this.id)" id=upload;"<?php echo $iID ?>" <?php echo $msg ?> class="btn btn-primary btn-block">Upload</button>
					</div>
<table class="table table-hover">
                      <thead>
                        <tr>
                          <th style="width:30%">Slide ID</th>
						  <th style="width:40%">Picture</th>
                          <th style="width:30%">Action</th>
                        </tr>
                      </thead>	
                      <tbody>
                          <?php 
								while($row = mysqli_fetch_array($res)){
								$iID=$row['SlideID'];
								$pic=$row['Image'];
							?>	 
						<tr>
							<td><?php echo $iID ?></td>
							<td>
							<?php
							    if(!empty($pic))
							    {
							        echo '<img style="height:180px; width:300px;" src="data:image/jpeg;base64,'.base64_encode( $pic ).'"/>'; 
							    }
							 
							?>
							</td>
							
							<td>
								<button type="button" onclick="openModalSamp(this.id)" id=view;"<?php echo $iID ?>" class="btn btn-round btn-success btn-sm">View</button>
								<a href="con_picCar.php?delID=<?php echo $iID ?>"><button type="button" <?php echo $msg2 ?> class="btn btn-round btn-success btn-sm">Remove</button></a>
								
							</td>
						</tr>
						
						<?php
								}
						?>
                      </tbody>
                    </table>
				
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
			

			



		</script>
				<!-- Large modal -->
                  
				  <!-- Large modal -->
				  
				  <!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width:30%">
                      <div class="modal-content">
			
					
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Picture</h4>
                        </div>
                        <div class="modal-body">
                <center>
              
			  <!--<div id="messin" style="font-size:15px; font-weight: bold"></div>-->
			  <div id="shows">

              </div>
			  
			  </center>
			  	    </div>
                        <div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
					
                      </div>
                    </div>
                  </div>
				  <!-- Large modal -->
		
		

	
</script>