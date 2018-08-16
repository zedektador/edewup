<?php
include("head.php");
?>
						  <button type="button" onclick="openModalCon(this.id)" id="1" class="btn btn-round btn-success btn-sm">Confirm</button>
						  
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
			    <input type="number" name="amtpaid" min="0" max"1000000">
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
						  
			<script>
						 function openModalCon(id){
				$('#modalConfirm').modal('show');
				//$("#resmodConfirm").val(id);
			}
			</script>
			
				 